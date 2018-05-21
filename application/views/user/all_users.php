<?php var_dump($result_array);?>

<?php foreach ($result_array as $row) : ?>

    <div class="card">
        <div>
        <div class="card-body"><?php echo $row['user_name'] ; echo  "        As      " ; echo $row['role_name'] ;  ?>
            <form action="<?php echo base_url()."User/view/".str_replace('@','%40',$row['user_name']);?>">
                <input type="submit"  class="btn btn-info m-b-10 m-l-5" value="Info" />
            </form>
        </div>
        </div>

    </div>


<?php endforeach;?>

