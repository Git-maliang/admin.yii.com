<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/6/22
 * Time: 下午12:17
 */
$this->title = '用户管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-responsive">
    <div id="sample-table-2_wrapper" class="dataTables_wrapper" role="grid">
        <div class="row">
            <div class="col-sm-6">
                <input type="text">
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover dataTable">
            <thead>
            <tr>
                <th class="center">
                    <label>
                        <input class="ace" type="checkbox">
                        <span class="lbl"></span>
                    </label>
                </th>
                <th class="sorting">Domain</th>
                <th>Price</th>
                <th>Clicks</th>
                <th>
                    Update
                </th>
                <th>Status</th>
                <th>操作</th></tr>
            </thead>
            <tbody>
            <tr>
                <td class="center">
                    <label>
                        <input class="ace" type="checkbox">
                        <span class="lbl"></span>
                    </label>
                </td>
                <td>year.com</td>
                <td>$48</td>
                <td>3,990</td>
                <td>Feb 15</td>
                <td>
                    <span class="label label-sm label-warning">Expiring</span>
                </td>

                <td>
                        <a class="blue margin-right" href="#">
                            <i class="fa fa-search-plus bigger-130"></i>
                        </a>
                        <a class="green" href="#">
                            <i class="fa fa-pencil bigger-130"></i>
                        </a>
                        <a class="red orange" href="#">
                            <i class="fa fa-trash bigger-130"></i>
                        </a>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-sm-3 hidden-xs">
                <div class="dataTables_info">
                    显示
                    <select name="sample-table-2_length" style="">
                            <option value="10" selected="selected">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    条
                </div>
            </div>
            <div class="col-sm-9">
                <div class="dataTables_paginate paging_bootstrap">
                    <ul class="pagination">
                        <li>
                            <a href="#">首页</a>
                        </li>
                        <li class="prev disabled">
                            <a href="#"><i class="fa fa-angle-double-left"></i></a>
                        </li>
                        <li class="active">
                            <a href="#">1</a>
                        </li>
                        <li>
                            <a href="#">2</a>
                        </li>
                        <li>
                            <a href="#">3</a>
                        </li>
                        <li>
                            <a href="#">4</a>
                        </li>
                        <li>
                            <a href="#">5</a>
                        </li>
                        <li>
                            <a href="#">6</a>
                        </li>
                        <li>
                            <a href="#">7</a>
                        </li>
                        <li>
                            <a href="#">8</a>
                        </li>
                        <li class="next">
                            <a href="#"><i class="fa  fa-angle-double-right"></i></a>
                        </li>
                        <li>
                            <a href="#">末页</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
