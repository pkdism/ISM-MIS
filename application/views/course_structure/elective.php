<div id="container">
	<h1>Welcome to Course Structure Page!</h1>
  <center>
  <?php echo "<h3>".$CS_session['course_name']." (".$CS_session['branch'].") for Session "."20".$CS_session['session'][0].$CS_session['session'][1]."-20".$CS_session['session'][2].$CS_session['session'][3]."</h3>"; ?>
  <h3>
  Add elective courses for Semester 
  <?php 
    //echo $duration;
    //echo "<br>";
    echo $CS_session['sem'];
  ?>
  </h3>
  <?php 
    echo form_open('select/add_elective_subjects');  
  ?>
  
      <?php for($counter = 1;$counter<=$CS_session['count_elective'];$counter++){ 
        if($options[$counter]>0)
        {
      ?> 
      <p>
      Enter details for Elective No <?php echo $counter;?> of Semester <?php echo $CS_session['sem']; ?>
      <table class="table table-condensed" style="width: auto">
      <tr>
        <td>Name</td>
        <td><input type="text" name="name<?php echo $counter;?>"/></td>
      </tr>
      <tr>
        <td>L</td>
        <td>
          <select name="L<?php echo $counter;?>">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>T</td>
        <td>
          <select name="T<?php echo $counter;?>">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>P</td>
        <td>
          <select name="P<?php echo $counter;?>">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Type</td>
        <td>
          <select name="type<?php echo $counter; ?>">
            <option value="0">Theory</option>
            <option value="1">Practical</option>
            <option value="2">Sessional</option>
            <option value="3">Non-Contact</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Add to</td>
        <td>
          <select name="list<?php echo $counter; ?>">
            <option value="0">Separate List for this Elective</option>
            <option value="1">Comprehensive List for this Course Structure</option>
          </select>
        </td>
      </tr>
      <input type="hidden" name=<?php echo "count_options".$counter; ?> value="<?php echo $options[$counter]; ?>">
      <input type="hidden" name=<?php echo "sequence".$counter; ?> value="<?php echo $seq_e[$counter]; ?>">
      <table>
        <tr>
          <th>Sl.No.</th>
          <th>Subject ID</th>
          <th>Subject Name</th>
        </tr>
        <?php for($i = 1;$i<=$options[$counter];$i++){ ?>
          <tr>
            <td>
              <?php echo $i;?>
            </td>
            <td>
              <input type="text" name="id<?php echo $counter.'_'.$i;?>"/>
            </td>
            <td>
              <input type="text" name="name<?php echo $counter.'_'.$i;?>"/>
            </td>
          </tr>
        <?php   } ?>
      </table>
      _________________________________________________________________________
      </table>
      <?php }
      } ?>
    </p>
      <input type="hidden" name="count_elective" value="<?php echo $count; ?>">
      <input type="hidden" name="aggr_id" value="<?php echo $aggr_id; ?>">
      <input type="hidden" name="sem" value="<?php echo $sem; ?>">
      <input type="hidden" name="duration" value="<?php echo $duration; ?>">
      <input type="hidden" name="course_name" value="<?php echo $course_name; ?>">
      <input type="hidden" name="branch" value="<?php echo $branch; ?>">
      <input type="hidden" name="session" value="<?php echo $session; ?>">
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  <?php
    echo form_close(); 
  ?>  
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
