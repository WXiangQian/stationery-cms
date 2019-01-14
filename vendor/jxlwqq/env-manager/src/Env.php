<?php

namespace Jxlwqq\EnvManager;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request;

class Env extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    private $env;

    public function __construct(array $attributes = [])
    {
        $this->env = config('admin.extensions.env-manager.env-file-path', base_path().'/.env');
        parent::__construct($attributes);
    }


    public function paginate()
    {
        $perPage = Request::get('per_page', 20);
        $page = Request::get('page', 1);
        $start = ($page - 1) * $perPage;
        $data = $this->getEnv();
        $list = array_slice($data, $start, $perPage);
        $list = static::hydrate($list);
        $paginator = new LengthAwarePaginator($list, count($data), $perPage);
        $paginator->setPath(url()->current());
        return $paginator;
    }

    public static function with($relations)
    {
        return new static;
    }

    public function findOrFail($id)
    {
        $item = $this->getEnv($id);
        return static::newFromBuilder($item);
    }


    public function save(array $options = [])
    {
        $data = $this->getAttributes();

        return $this->setEnv($data['key'], $data['value']);
    }

    /**
     * Get .env variable.
     * @param null $id
     * @return array|mixed
     */
    private function getEnv($id = null)
    {
        $string = file_get_contents($this->env);
        $string = preg_split('/\n+/', $string);
        $array = [];
        foreach ($string as $k => $one) {
            if (preg_match('/^(#\s)/', $one) === 1 || preg_match('/^([\\n\\r]+)/', $one)) {
                continue;
            }
            $entry = explode("=", $one, 2);
            if (!empty($entry[0])) {
                $array[] = ['id' => $k + 1, 'key' => $entry[0], 'value' => isset($entry[1]) ? $entry[1] : null];
            }
        }
        if (empty($id)) {
            return $array;
        }
        $index = array_search($id, array_column($array, 'id'));

        return $array[$index];
    }

    /**
     * Update or create .env variable.
     * @param $key
     * @param $value
     * @return bool
     */
    private function setEnv($key, $value)
    {
        $array = $this->getEnv();
        $index = array_search($key, array_column($array, 'key'));
        if ($index !== false) {
            $array[$index]['value'] = $value; // 更新
        } else {
            array_push($array, ['key' => $key, 'value' => $value]); // 新增
        }
        return $this->saveEnv($array);
    }

    /**
     * Save .env variable.
     * @param $array
     * @return bool
     */
    private function saveEnv($array)
    {
        if (is_array($array)) {
            $newArray = [];
            $i = 0;
            foreach ($array as $env) {

                if (preg_match('/\s/', $env['value']) > 0 && (strpos($env['value'], '"') > 0 && strpos($env['value'], '"', -0) > 0)) {
                    $env['value'] = '"'.$env['value'].'"';
                }
                $newArray[$i] = $env['key']."=".$env['value'];
                $i++;
            }
            $newArray = implode("\n", $newArray);
            file_put_contents($this->env, $newArray);
            return true;
        }
        return false;
    }

}