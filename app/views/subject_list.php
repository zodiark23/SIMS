
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<!-- TODO :
refactor hoshi inline widths here @morbid
add styling on bottom note
    -->

<div class="main-container">
<div class="content-container dashboard">
    <div class="dashboard-container">
        <div class="content-panel">
            <h3 class="dashboard-section-title">Subjects Lists</h3>                        
            
            <table width=100%>
            <tr>
                <th> Subject Name</th>
                <th> Category</th>
                <th> Action</th>
            </tr>
            <?php
            /**
             * Format
             * 
             * Educational
             *  - Subjects
             *  - Subjects
             */


             foreach($this->data as $curriculum => $subjects){

                    if(!empty($subjects)){

                        foreach($subjects as $s){
            ?>
                    <tr>
                        <td><?= ($s['subject_name'] ?? "") ?></td>
                        <td><?= ($curriculum ?? "") ?></td>
                        <td>
                            <a href="<?=BASE_URL?>/admin/edit-subject/<?=($s['subject_id'] ?? "")?>">Edit </a> | 
                            <a data-<?= md5(time())?>=<?=($s['subject_id'] ?? "")?> class="del-subject">Delete </a>
                        </td>
                    </tr>
                    <!-- @GAB needed na parent().parent() nung delete class ung tr aun binubura ko sa .remove() -->
            <?php
                        }
                    }
             }
            ?>
            </table>
        </div>

        <?php include_once("side-nav.php") ?>


        <script>
        
             $('.del-subject').on("click", function(){
                 var that = $(this);
                 var id = $(this).data('<?= md5(time())?>');
                var c = confirm("Warning : This process is irreversible are you sure?");
                
                if(c){

                    $.ajax({
                        
                        url : BASE_URL+"/php/delete_subject.php",
                        type : "post",
                        data : {id : id},
                        success : function(data){
                            x = JSON.parse(data);
                            
                            if(x.code == "00"){
                                that.parent().parent().remove();
                                alert(x.message);
                            }else{
                                alert(x.message);
                            }
                        }
                    });
                }
             });
        </script>
    </div>
</div>
</div>


