<?php 

namespace app\core;

class ItemFactory
{
    public function todoListItem($listItem)
    {

        $result = '<li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
            <div class="fw-bold"><a class="todo-list-item-link" href="#">'. $listItem['title'] .'</a></div>
            '. $listItem['description'] .'

        </div>
        <div class="ms-2 ">
            <br>
            <form action="" method="post" style="display: inline-block">
            <input name="share-list" type="hidden" value="">
            <button class="badge bg-primary rounded-pill todo-list-button">Share</button>
        </form>
        
        <form action="" method="post" style="display: inline-block">
            <input name="delete-list" type="hidden" value="'. $listItem['id'] .'">
            <button class="badge bg-danger rounded-pill todo-list-button">Delete</button>
        </form>  
        </div>
    </li>';

    return $result;
    }
}

?>