<?php 
    require_once __DIR__.'/../vendor/autoload.php';
    include_once __DIR__.'/../layout/header.php';

?>

<div class="row">
    <div class="col-lg-5 content">
        <h3>Public todo lists</h3>
        <br>
        <ol class="list-group list-group">
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><a class="todo-list-item-link" href="#">Subheading</a></div>
                    Content for list item
                   
                </div>
                <div class="ms-2 ">
                    <br>
                    <button class="badge bg-primary rounded-pill todo-list-button">Share</button>
                    <button class="badge bg-danger rounded-pill todo-list-button">Delete</button>
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><a class="todo-list-item-link" href="#">Subheading</a></div>
                    Content for list item
                   
                </div>
                <div class="ms-2 ">
                    <br>
                    <button class="badge bg-primary rounded-pill todo-list-button">Share</button>
                    <button class="badge bg-danger rounded-pill todo-list-button">Delete</button>
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><a class="todo-list-item-link" href="#">Subheading</a></div>
                    Content for list item
                   
                </div>
                <div class="ms-2 ">
                    <br>
                    <button class="badge bg-primary rounded-pill todo-list-button">Share</button>
                    <button class="badge bg-danger rounded-pill todo-list-button">Delete</button>
                </div>
            </li>
        </ol>
    </div>
    <div class="col-lg content">
        <h3>Public tasks</h3>
        <br>
        <ol class="list-group list-group-numbered">
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Subheading</div>
                    Content for list item
                </div>
                <span class="badge bg-primary rounded-pill">14</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Subheading</div>
                    Content for list item
                </div>
                <span class="badge bg-primary rounded-pill">14</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Subheading</div>
                    Content for list item
                </div>
                <span class="badge bg-primary rounded-pill">14</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Subheading</div>
                    Content for list item
                </div>
                <span class="badge bg-primary rounded-pill">14</span>
            </li>
            
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Subheading</div>
                    Content for list item
                </div>
                <span class="badge bg-primary rounded-pill">14</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Subheading</div>
                    Content for list item
                </div>
                <span class="badge bg-primary rounded-pill">14</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Subheading</div>
                    Content for list item
                </div>
                <span class="badge bg-primary rounded-pill">14</span>
            </li>
        </ol>
    </div>
</div>






<?php include_once __DIR__.'/../layout/footer.php';  ?>