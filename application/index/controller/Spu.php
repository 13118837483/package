<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Sku;
use app\index\model\Spu as spuModel;
use think\Db;

class Spu extends Controller
{
    protected $model = null;
    protected $skuModel = null;

    public function __construct()
    {
        parent::__construct();
        $this->model = new spuModel;
        $this->skuModel = new Sku();
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {


    }


    public function save()
    {

        $post = $this->request->post();
        //校验SPU数据
        $validated = $this->validate($post, [
            'title' => 'require|length:1,50',
            'sub_title' => 'require|length:6,20',
            'category_id' => 'require',
            'brand_id' => 'require',
            'spg_id' => 'require',
            'saleable' => 'require',
            'valid' => 'require',

        ]);
        if ($validated !== true) {
            return $this->errorJson(self::ERROR_PARAMETER, $validated);
        }

        //校验SKU数据
        foreach ($post['sku'] as $v) {
            $validated = $this->validate($v, [

                'title' => 'require',
                'price' => 'require'
            ]);
            if ($validated !== true) {
                return $this->errorJson(self::ERROR_PARAMETER, $validated);
            }
        }
        Db::startTrans();
        try {
            $saveSpu = $this->model::create([
                'title' => $post['title'],
                'sub_title' => $post['sub_title'],
                'category_id' => $post['category_id'],
                'brand_id' => $post['brand_id'],
                'spg_id' => $post['spg_id'],
                'saleable' => $post['saleable'],
                'valid' => $post['valid'],
            ]);
            if (!$saveSpu->id) {
                Db::rollback();
                return $this->errorJson(self::ERROR_SAVE);
            }
            foreach ($post['sku'] as &$item) {
                $item['spu_id'] = $saveSpu->id;
            }
            //新增附表数据
            $this->skuModel->allowField(true)->saveAll($post['sku']);
            Db::commit();
            return $this->json();
        } catch (\Exception $e) {
            Db::rollback();
            throw $e;
            return $this->errorJson(self::ERROR_SAVE);
        }


    }

    /**
     * 显示指定的资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function read($id)
    {
//        $data = $this->model->with('Sku')->where(['id' => $id])->find();
        $data = $this->model->join('sku', 'spu.id = sku.spu_id', 'left')->field('spu.*')->field("min(sku.price) as min_price,max(sku.price) as max_price")
            ->group('spu.id')
            ->select();
        return $this->json($data);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param int $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param \think\Request $request
     * @param int $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
