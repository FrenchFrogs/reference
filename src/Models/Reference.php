<?php namespace FrenchFrogs\Models;

use Cache;

/**
 * Classe de gestion des références
 *
 * Class Reference
 * @package FrenchFrogs\Models
 */
class Reference
{

    /**
     * CPrefix utiliser pour le cache
     *
     */
    const CACHE_PREFIX = 'reference_';

    /**
     * Collection de reference
     *
     * @var
     */
    protected $collection;


    /**
     * Full data
     *
     * @var
     */
    protected $data;

    /**
     * Recuperation des données de la collection
     *
     * @param bool $force_refresh
     */
    public function getData($force_refresh = false)
    {

        // si on force le refresh, on efface les donnée
        if ($force_refresh) {
            unset($this->data);
        }

        // si pas de donnée on regénère
        if (is_null($this->data)) {

            // adresse du cache
            $cache = static::CACHE_PREFIX . $this->collection;

            // si pas les données en cache, on les génère
            if (!Cache::has($cache)) {
                $data = Db\Reference::where('collection', $this->collection)->all();
                Cache::forever($cache, $data);
            } else {
                $data = Cache::get($cache);
            }

            // inscription des data
            $this->data = $data;
        }
    }

    /**
     * Constructeur
     *
     * Reference constructor.
     * @param $collection
     */
    public function __construct($collection)
    {
        $this->collection = $collection;




    }


    /**
     * Création d'une référence en base de donnée
     *
     * @param $id
     * @param $name
     * @param $collection
     * @param null $data
     * @return static
     */
    static public function createDatabaseReference($id, $name, $collection, $data = null )
    {
        return Db\Reference::create([
            'reference_id' => $id,
            'name' => $name,
            'collection' => $collection,
            'data' => json_encode($data)
        ]);
    }

    /**
     * Soft delete a reference
     *
     * @param $id
     * @throws \Exception
     */
    static public function removeDatabaseReference($id)
    {
        Db\Reference::find($id)->delete();
    }

}