<?php

namespace App\Admin\Controllers;

use App\Models\Shop;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ShopController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Shop';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Shop());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('category.name', __('Category Name'));
        $grid->column('name', __('Name'));
        $grid->column('furigana', __('Furigana'))->sortable();
        $grid->column('description', __('Description'));
        $grid->column('price', __('Price'))->sortable();
        $grid->column('image', __('Image'))->image();
        $grid->column('business_hours', __('Business hours'))->sortable();
        $grid->column('postal_code', __('Postal code'));
        $grid->column('address', __('Address'));
        $grid->column('phone', __('Phone'));
        $grid->column('regular_holiday', __('Regular holiday'));
        $grid->column('recommend_flag',__('Recommend Flag'));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->filter(function($filter){
            $filter->like('name', '店舗名');
            $filter->like('description', '商品説明');
            $filter->in('category_id', 'カテゴリー')->multipleSelect(Category::all()->pluck('name', 'id'));
            $filter->equal('recommend_flag', 'おすすめフラグ')->select([ '0' => 'false', '1' => 'true' ]);
            $filter->between('created_at', '登録日')->datetime();
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Shop::findOrFail($id));

        $show->field('id', __('Id'))->sortable();
        $show->field('category.name', __('Category Name'));
        $show->field('name', __('Name'));
        $show->field('furigana', __('Furigana'));
        $show->field('description', __('Description'));
        $show->field('price', __('Price'));
        $show->field('image', __('Image'))->image();
        $show->field('business_hours', __('Business hours'));
        $show->field('postal_code', __('Postal code'));
        $show->field('address', __('Address'));
        $show->field('phone', __('Phone'));
        $show->field('regular_holiday', __('Regular holiday'));
        $show->field('recommend_flag',__('Recommend Flag'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Shop());

        $form->select('category_id', __('Category Name'))->options(Category::all()->pluck('name', 'id'));
        $form->text('name', __('Name'));
        $form->text('furigana', __('Furigana'));
        $form->textarea('description', __('Description'));
        $form->select('price', __('Price'))->options(['~999', '1000~~1999', '2000~2999', '3001~3999', '4000~4999', '5000~']);
        $form->text('business_hours', __('Business hours'));
        $form->text('postal_code', __('Postal code'));
        $form->text('address', __('Address'));
        $form->mobile('phone', __('Phone'));
        $form->multipleSelect('regular_holiday', __('Regular holiday'))->options(['日曜日','月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日']);
        $form->image('image', __('Image'));
        $form->switch('recommend_flag', __('Recommend Flag'));

        return $form;
    }
}
