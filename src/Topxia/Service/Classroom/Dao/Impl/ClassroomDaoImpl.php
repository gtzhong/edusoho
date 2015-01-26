<?php
namespace Topxia\Service\Classroom\Dao\Impl;

use Topxia\Service\Common\BaseDao;
use Topxia\Service\Classroom\Dao\ClassroomDao;

class ClassroomDaoImpl extends BaseDao implements ClassroomDao
{

    protected $table = 'classroom';

    private $serializeFields = array(
        'tagIds' => 'json',
    );

    public function searchClassrooms($conditions,$orderBy,$start,$limit)
    {
        $this->filterStartLimit($start, $limit);

        $builder = $this->_createClassroomSearchBuilder($conditions)
            ->select('*')
            ->setFirstResult($start)
            ->setMaxResults($limit)
            ->addOrderBy($orderBy[0], $orderBy[1]);
  
        return $builder->execute()->fetchAll() ? : array();  
    }

    public function searchClassroomsCount($conditions)
    {
        $builder = $this->_createClassroomSearchBuilder($conditions)
                         ->select('count(id)');
        return $builder->execute()->fetchColumn(0); 
    }

    private function _createClassroomSearchBuilder($conditions)
    {

        if (isset($conditions['title'])) {
            $conditions['title'] = "%{$conditions['title']}%";
        }

        $builder = $this->createDynamicQueryBuilder($conditions)
            ->from($this->table,$this->table)
            ->andWhere('title like :title');

        return $builder;
    }

}