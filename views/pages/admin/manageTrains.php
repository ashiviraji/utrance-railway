<div class="load-content-container">
    <div class="load-content">
        <div class="load-content--manage-trains">
              <form class="dashboard-searchbar--container" method='POST' action="/utrance-railway/trains" >
                <input type="text" class="dashboard-searchbar" placeholder="Search trains by name or id" name="searchTrain"/>
                <button>
                <svg class="search-icon__btn">
                  <use xlink:href="/utrance-railway/public/img/svg/sprite.svg#icon-magnifying-glass"></use>
                </svg>
                </button>
              </form>

              <a href="/utrance-railway/trains/add" class="btn btn-square-blue">
                <div class="addbtn-text">Add Train</div>
                <svg class="addbtn-img">
                  <use xlink:href="/utrance-railway/public/img/svg/sprite.svg#icon-circle-with-plus"></use>
                </svg> 
              </a>
              <div class="search__results-container">
                <?php
                  $dom = new DOMDocument;
                  libxml_use_internal_errors(true);
                  $dom->loadHTML('...');
                  libxml_clear_errors();
              
                  if(isset($trains))
                  {
                    foreach($trains as $key => $value)
                    {
                      $html ="<div class='search__result-card'>
                        <div class='search__result-train-idbox'>#
                      ";

                      $html .= "<span class='train__id ' name='id'>" .$value['train_id'] . "</span></div>";
                    
                      $html .= "<div class='search__result-train-namebox'>" .$value['train_name'] . "</div>";
                      $html .= "<div class='search__result-train-typebox'>" .$value['train_type'] . "</div>";
                      $train_id=$value['train_id'];
                      // $train_active_status=$value['train_active_status'];

                      $html .= "<a href='/utrance-railway/trains/view?id=$train_id' class='btn btn-box-white margin-r-s'>";
                      $html .= "View</a>";
                      
                      $html .= "<a href='/utrance-railway/trains/delete?id=$train_id' class='btn btn-box-white btn-box-white--delete'>";
                      $html .= "Delete</a></div></div>";
                      
                      $dom = new DOMDocument();
                      $dom->loadHTML($html);
                      print_r($dom->saveHTML());
                    }
                  }      
                ?>
              </div>    
        </div>
    </div>
</div>
</div>
























  
