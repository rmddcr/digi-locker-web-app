<?php var_dump($result_array[0]);?>

<?php foreach ($result_array as $row) : ?>

    <div class="card">


        <table id="lockers_current_table" class="display">

            <tbody>
            <tr>
                <td><?php echo $row['role_name'] ; ?></td>
                <td><form action="<?php echo base_url()."User/view/";?>">
                        <input type="submit"  class="btn btn-info m-b-10 m-l-5" value="Edit privileges" />
                    </form>
                </td>

            </tr>
            </tbody>
        </table>


    </div>


<?php endforeach;?>

