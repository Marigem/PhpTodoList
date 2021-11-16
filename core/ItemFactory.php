<?php 

namespace app\core;

use app\core\model\User;

class ItemFactory
{
    public function todoListItem($listItem, $public = false)
    {

        $result = '<li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto text-wrap text-break">
            <div class="fw-bold"><a class="todo-list-item-link" href="list.php?item='. $listItem['id'] .'">'. $listItem['title'];
            
        if ($public)
        {
            $userName = Application::$app->fetcher->fetchUserNameByListId($listItem['id']);
            $result .= ' <i  style="font-size: 10px;"> - posted by ' . $userName . " </i>" ;
        }
        else
        {
            $result .= ' <i style="font-size: 10px;"> - click to open </i>';
        }
        
        $result .= ' </a></div>
            <span class="todo-list-description">'. $listItem['description'] . '</span>';
        if (Application::$app->auth->userOwnsListItem($listItem['id']))
        {
            $result .= 
            '</div>
            <div class="d-flex align-items-end flex-row bd-highlight mt-auto">
                <br>
                <form action="share.php" method="post" style="display: inline-block">
                <input name="share-list" type="hidden" value="'. $listItem['id'] .'">
                <button class="badge bg-primary rounded-pill todo-list-button">Share</button>
            </form>
            
            <form action="" method="post" style="display: inline-block">
                <input name="delete-list" type="hidden" value="'. $listItem['id'] .'">
                <button class="badge bg-danger rounded-pill todo-list-button">Delete</button>
            </form>  
            </div>
        </li>';
        }

    return $result;
    }

    public function taskItem($listId, $task, $public = false)
    {
        $result = '<li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto text-wrap text-break">
            '. $task['description'] .'
        </div>';

        if (Application::$app->auth->userOwnsListItem($listId) && $public === false)
        {
            $result .= '
                <div class="d-flex align-items-end flex-row bd-highlight mt-auto">

                <form action="" method="post" style="display: inline-block">
                    <input name="share-task" type="hidden" value="'. $task['id'] .'">
                    <button class="badge bg-primary rounded-pill todo-list-button">'. 
                        (Application::$app->sharing->taskAlreadyShared($task['id']) ? 'Unshare' : 'Share') .'</button>
                </form>

                <form action="" method="post" style="display: inline-block">
                    <input type="hidden" name="list-id" value="'. $listId .'">
                    <input name="delete-task" type="hidden" value="'. $task['id'] .'">
                    <button class="badge bg-danger rounded-pill todo-list-button">Delete</button>
                </form>
            </div>
        </li>';
        }
        

        return $result;
    }

    public function userItem(User $user, $listId, $alreadyShared): string
    {
        $result = '<li class="list-group-item d-flex justify-content-between align-items-start">
                    
                        <div class="ms-2 me-auto mt-auto mb-auto">
                        <div class="fw-bold">'. $user->name .'</div>
                        </div>
                        <form action="" method="post" style="display: inline-block;">
                            <input type="hidden" name="share-list" value="'. $listId .'">
                            <input type="hidden" name="user_id" value="'. $user->id .'">
                            <button class="btn btn-sm btn-primary rounded" style="width:100px;">'. ($alreadyShared ? 'Unshare' : 'Share') .'</button>
                        </form>
                    </li>';
        
        return $result;
    }
}

?>