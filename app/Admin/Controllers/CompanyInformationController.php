<?php

namespace App\Admin\Controllers;

use App\Models\CompanyInformation;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CompanyInformationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'CompanyInformation';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CompanyInformation());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('establishment', __('Establishment'));
        $grid->column('representative', __('Representative'));
        $grid->column('postal_code', __('Postal code'));
        $grid->column('address', __('Address'));
        $grid->column('business', __('Business'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(CompanyInformation::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('establishment', __('Establishment'));
        $show->field('representative', __('Representative'));
        $show->field('postal_code', __('Postal code'));
        $show->field('address', __('Address'));
        $show->field('business', __('Business'));
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
        $form = new Form(new CompanyInformation());

        $form->text('name', __('Name'));
        $form->text('establishment', __('Establishment'));
        $form->text('representative', __('Representative'));
        $form->text('postal_code', __('Postal code'));
        $form->text('address', __('Address'));
        $form->text('business', __('Business'));

        return $form;
    }
}
