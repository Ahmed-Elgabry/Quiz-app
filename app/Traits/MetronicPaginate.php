<?php
namespace App\Traits;

use Illuminate\Support\Facades\Schema;

trait MetronicPaginate
{

    public static function getColumns()
    {
        $table = with(new static)->getTable(); //return table name
        $columns = Schema::getColumnListing($table); //get all column names from a table
        return $columns;
    }
    public static function SearchIds($modelQuery,$func){
        $query = request()->input('query');
        $modelget = $modelQuery->get();
        $data = static::getJsonDecode($modelget);

        if ($query) {
            $value = $query['generalSearch'];
            $data = static::$func($data, $value);
        }else{
            $value = '';
            $data = static::$func($data, $value);
            /* $data = $modelQuery ; */
        }

        $ids =[];
        for($i=0;$i<$modelQuery->count();$i++){
            if(isset($data[$i]['id'])){
            $ids[$i] = $data[$i]['id'];
            }
        }

        return $ids;
    }

    public static function arraySearchUsers($array, $keyword)
    {
        return array_filter($array, function ($a) use ($keyword) {
            return false !== stripos($a['name'], $keyword)
            || false !== stripos($a['username'], $keyword)
            || false !== stripos($a['created_at'], $keyword)
            || false !== stripos($a['email'], $keyword);
        });
    }

    public static function arraySearchBlockedUsers($array, $keyword)
    {
        return array_filter($array, function ($a) use ($keyword) {
            return false !== stripos($a['name'], $keyword)
            || false !== stripos($a['username'], $keyword)
            || false !== stripos($a['email'], $keyword)
            || false !== stripos($a['is_editor'], $keyword)
            || false !== stripos($a['created_at'], $keyword)
            || false !== stripos($a['deleted_at'], $keyword);
        });
    }

    public static function arraySearchEditors($array, $keyword)
    {
        return array_filter($array, function ($a) use ($keyword) {
            return false !== stripos($a['name'], $keyword)
            || false !== stripos($a['username'], $keyword)
            || false !== stripos($a['created_at'], $keyword)
            || false !== stripos($a['email'], $keyword);
        });
    }

    public static function arraySearchArticles($array, $keyword)
    {
        return array_filter($array, function ($a) use ($keyword) {
            return false !== stripos($a['title'], $keyword)
            || false !== stripos($a['is_arabic'], $keyword)
            || false !== stripos($a['is_featured'], $keyword)
            || false !== stripos($a['status'], $keyword)
            || false !== stripos($a['created_at'], $keyword)
            /* || false !== stripos($a['updated_at'], $keyword) */
            || false !== stripos($a['user']['username'], $keyword);
        });
    }

    public static function arraySearchDeletedArticles($array, $keyword)
    {
        return array_filter($array, function ($a) use ($keyword) {
            return false !== stripos($a['title'], $keyword)
            || false !== stripos($a['is_arabic'], $keyword)
            || false !== stripos($a['status'], $keyword)
            || false !== stripos($a['created_at'], $keyword)
            || false !== stripos($a['deleted_at'], $keyword)
            || false !== stripos($a['user']['username'], $keyword);
        });
    }

    public static function arraySearchCommonQuestion($array, $keyword)
    {
        return array_filter($array, function ($a) use ($keyword) {
            return false !== stripos($a['question'], $keyword)
            || false !== stripos($a['is_arabic'], $keyword);
        });
    }

    public static function arraySearchResults($array, $keyword)
    {
        return array_filter($array, function ($a) use ($keyword) {
            return
            false !== stripos($a['quiz']['quiz_name'], $keyword) || false !== stripos($a['name'], $keyword)
            || false !== stripos($a['created_at'], $keyword);
            /* || false !== stripos($a['results'], $keyword) || false !== stripos($a['quiz']['grade'], $keyword)
            || false !== stripos($a['results']+' / '+$a['quiz']['grade'], $keyword)
            || false !== stripos($a['results']+' / '+$a['quiz']['grade'], $keyword)
            || false !== stripos($a['user_grade'], $keyword)
            || false !== stripos($a['max_grade'], $keyword)
            || false !== stripos($a['user_grade']+'/'+$a['max_grade'], $keyword)
            || */
        });
    }
    public static function arraySearchUserQuiz($array, $keyword)
    {
        return array_filter($array, function ($a) use ($keyword) {
            return false !== stripos($a['quiz_name'], $keyword)
            || false !== stripos($a['created_at'], $keyword)
            || false !== stripos($a['is_private'], $keyword)
            || false !== stripos($a['results_share'], $keyword)
            || false !== stripos($a['hide_result'], $keyword);
        });
    }

    public static function arraySearchUserQuizShownResults($array, $keyword)
    {
        return array_filter($array, function ($a) use ($keyword) {
            return false !== stripos($a['created_at'], $keyword);
        });
    }

    public static function arraySearchAdminUserQuiz($array, $keyword)
    {
        return array_filter($array, function ($a) use ($keyword) {
            return false !== stripos($a['quiz_name'], $keyword)
            || false !== stripos($a['created_at'], $keyword)
            || false !== stripos($a['lang'], $keyword)
            || false !== stripos($a['is_private'], $keyword)
            || false !== stripos($a['category']['name'], $keyword)
            || false !== stripos($a['user']['username'], $keyword)
            /* || false !== stripos($a['is_private'], $keyword)
            || false !== stripos($a['results_share'], $keyword)
            || false !== stripos($a['hide_result'], $keyword) */;
        });
    }

    public static function arraySearchAdminQuickQuiz($array, $keyword)
    {
        return array_filter($array, function ($a) use ($keyword) {
            return false !== stripos($a['quiz_name'], $keyword)
            || false !== stripos($a['created_at'], $keyword)
            || false !== stripos($a['lang'], $keyword)
            || false !== stripos($a['category']['name'], $keyword)
            || false !== stripos($a['owner_name'], $keyword);
        });
    }

    public static function arraySearchCategory($array, $keyword)
    {
        return array_filter($array, function ($a) use ($keyword) {
            return false !== stripos($a['name'], $keyword)
            || false !== stripos($a['created_at'], $keyword)
            || false !== stripos($a['lang'], $keyword);
        });
    }


    public static function getJsonDecode($modelQuery)
    {
        return json_decode($modelQuery, true);
    }

    public static function scopeMetronicPaginate($modelQuery,$func)
    {
        $columns = static::getColumns();
        $pagination = request()->pagination;
        //$query = request()->input('query');
        $sort = request()->sort;
        request()->request->add(['page' => $pagination['page']]);
        $model = $modelQuery;

        //search
        $ids = static::SearchIds($model,$func);
        $model = $model->whereIn('id',$ids);
        

            //sort
        if ($sort && in_array($sort['field'], $columns)) {
            if ($sort['field'] != 'id' /* && $sort['field'] != 'created_at' */){
                $model->orderBy($sort['field'], $sort['sort']);
            }
        }


        $pagination['rowIds'] = $modelQuery->pluck('id'); // add this for multi select
        $model = $model->paginate($pagination['perpage']);

        $pagination['total'] = $model->total();
        $pagination['pages'] = $model->lastPage();
        $pagination['sort'] =  $sort['sort'] ?? '';
        $pagination['field'] = $sort['field'] ?? '';
        $pagination['iTotalRecords'] = $model->total();
        $pagination['iTotalDisplayRecords'] = $model->total();
        $pagination['sEcho'] = 0;
        $response = [
            'meta' => $pagination,
            'data' => $model->toArray()['data']
        ];
        return $response;
    }

}
