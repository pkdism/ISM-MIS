<?php
	$ui = new UI();
	
	// This row will not be printed because of the noPrint() property
	$topRow = $ui->row()->noPrint()->open();
		$alertCol = $ui->col()->width(6)->open();	
			$ui->callout()
			   ->title("This is just a small example")
			   ->uiType("warning")
			   ->desc('This example shows only a handful of the UI options. ' .
					  'See the <a href="http://172.16.8.5/wiki/index.php/UI_Library">UI Library wiki</a> for a detailed list of options. ' .
					  'Help us build this page by adding more example codes.')
			   ->show();
		
			$ui->alert()
			   ->title("Is this example working for you?")
			   ->uiType("info")
			   ->desc('If the example is not working for you, the error is probably because of php short tags (<code>&lt;?</code>). Instead of converting all short tags to <code>&lt;?php</code>, you can enable the <code>short_open_tag</code> property in the php.ini file. <a href="http://stackoverflow.com/q/2185320/1492578" target="_blank">Here\'s how!</a>')
			   ->show();
		$alertCol->close();

		$printCol = $ui->col()->width(6)->open();
			$printBox = $ui->box()
			               ->icon($ui->icon("print"))
						   ->title("Print this page")
						   ->tooltip("Printing this page wouldn't print this row. How awesome is that!")
						   ->open();
?>
<p>Everything in the view will be printed by default. To ignore something that shouldn't be printed, use the <code>noPrint()</code> property on that <code>Element</code>.</p>
<pre>
$ui->someElem()
   ...
   ->noPrint()
</pre>
<p>To make a Print button, use <code>$ui->printButton()->show()</code>. All other properties of <code>Button</code>s are still valid on the print button. For instance, you can set its id, name, UI type or value.</p>

<?
				$ui->printButton()->show();
			$printBox->close();
		$printCol->close();
	$topRow->close();

?><h2 class="page-header">Different box types</h2><?

$boxTypesRow = $ui->row()->open();
	$col = $ui->col()->width(4)->open();
		$box = $ui->box()
				  ->title("Default Box")
				  ->open();
?><p>This is the default box. It is the simplest box you can create. Use the following to create this:</p>
<pre>
$box = $ui->box()
          ->title("Default Box")
          ->open();
</pre><?
		$box->close();
	$col->close();		


	$col = $ui->col()->width(4)->open();
		
		$box = $ui->box()
				  ->title("A different UI type")
				  ->uiType("success")
				  ->open();
?><p>You can add some UI types to boxes based on their uses:</p>
<pre>
$box = $ui->box()
          ->title("A different UI type")
          ->uiType("success")
          ->open();
</pre><?
		$box->close();
	$col->close();
	
	$col = $ui->col()->width(4)->open();
		
		$box = $ui->box()
				  ->title("Add an awesome icon")
				  ->uiType("info")
				  ->icon($ui->icon('star'))
				  ->open();
				  
		?><p>Add icons to boxes. Here are a few icons: </p>
        
        <h4><? 
			$iconSamples = array("user", "tags", "edit", "check-circle", "upload", "key", "book", "camera");
			for($i = 0; $i < sizeof($iconSamples); $i++)  {
				$ui->icon($iconSamples[$i])->show(); 
				echo " ";
			}
		?></h4>
        
        <p>Choose from over 400 icons. <a href="http://fontawesome.io/icons/" target="_blank">See the full list</a>.</p>
<pre>
$box = $ui->box()
          ->title("Add an awesome icon")
          ->icon($ui->icon('star'))
          ->open();
</pre><?
		$box->close();
	$col->close();

$boxTypesRow->close();

$boxTypesRow = $ui->row()->open();
	$col = $ui->col()->width(6)->open();
		$box = $ui->box()
				  ->title("Add tooltips")
				  ->tooltip("You can also add a tooltip for additional help.")
				  ->solid()
				  ->icon($ui->icon("info-circle"))
				  ->uiType("primary")
				  ->open();
				?><p>You can add tooltips, make the box solid and use different colors. Use the following to create this:</p>
<pre>
$box = $ui->box()
          ->tooltip("You can also add a tooltip for additional help.")
          ->solid()
          ->uiType("primary")
          ->open();
</pre><?
		$box->close();
	$col->close();		

	$col = $ui->col()->width(3)->open();
		$box = $ui->box()
				  ->title("Here's another color")
				  ->tooltip("See the wiki for a lists of UI types.")
				  ->solid()
				  ->uiType("info")
				  ->open();
				?><p>You can add tooltips, make the box solid and use different colors. Use the following to create this:</p>
<pre>
$box = $ui->box()
          ->solid()
          ->uiType("info")
          ->open();
</pre><?
		$box->close();
	$col->close();		

	$col = $ui->col()->width(3)->open();
		$box = $ui->box()
				  ->title("And another color")
				  ->tooltip("See the wiki for a lists of UI types.")
				  ->solid()
				  ->uiType("warning")
				  ->open();
				?><p>You can add tooltips, make the box solid and use different colors. Use the following to create this:</p>
<pre>
$box = $ui->box()
          ->solid()
          ->uiType("warning")
          ->open();
</pre><?
		$box->close();
	$col->close();
$boxTypesRow->close();

$loadingBoxRow = $ui->row()->open();
	$col = $ui->col()->width(4)->open();
		$box = $ui->box()
				  ->id("loadingBoxExample")
				  ->title("Awesome data loading inside")
				  ->open();
			?><p>
            This box is in a loading state. Something is going to happen inside - stay tuned. This box is in a loading state. Something is going to happen inside - stay tuned. This box is in a loading state. Something is going to happen inside - stay tuned. This box is in a loading state. Something is going to happen inside - stay tuned. This box is in a loading state. Something is going to happen inside - stay tuned. This box is in a loading state. Something is going to happen inside - stay tuned.
			</p>
			<hr />
			<?
			$ui->button()
			   ->value("Do something")
			   ->uiType("primary")
			   ->icon($ui->icon("check"))
			   ->show();
			echo " ";
			$ui->button()
			   ->value("Don't do it")
			   ->icon($ui->icon("remove"))
			   ->uiType("danger")
			   ->show();
			   
		$box->close();
?>
	<script type="text/javascript">
		/*
		 * This is just an example. DO NOT place your scripts here. Place it in a .js file and link it through the controller.
		 */
		$(document).ready(function() {
			/*
			 * This example shows and hides loading. Normally, you'd do this when you're loading something asynchronously (via AJAX).
			 * For a more concrete example, see the /assets/js/ui_example/user-loader.js
			 */
			 var isLoading = false;
			 var $loadingBox = $("#loadingBoxExample"); // Selecting the box element
			 setInterval(function() {
				 if(isLoading) $loadingBox.hideLoading(); // Hides the loading gif.
				 else		   $loadingBox.showLoading(); // Shows the loading gif;
				 isLoading = !isLoading;
			 }, 3000);
		});
	</script>
<?
	$col->close();
	
	$col = $ui->col()->width(8)->open();
		$box = $ui->box()
				  ->title("Using the loading gif")
				  ->solid()
				  ->uiType("primary")
				  ->open();
		?>
			<p>
            First, set an <code>ID</code> to the box, by using the <code>->id("someID")</code> property. In JavaScript, use the <code>hideLoading()</code> and <code>showLoading()</code> functions to hide and show  the loading gif respectively.
            </p>
<pre>
var $myBox = $("#myBoxId");
$myBox.showLoading();  // This shows the loading gif
...
$myBox.hideLoading()   // This hides the loading gif
</pre>
        <?
				$ui->callout()
				   ->uiType("warning")
				   ->desc('<strong>DO NOT</strong> place your scripts directly in the view. Place it in a .js file and link it through the controller.')
				   ->show();

				$ui->callout()
				   ->uiType("info")
				   ->desc('View the source of this page to see how loading works Normally, you\'d do this when you\'re loading something asynchronously (via AJAX). For a more concrete example, see the <a href="#">/assets/js/ui_example/user-loader.js</a>')
				   ->show();
		$box->close();
	$col->close();
$loadingBoxRow->close();


$tabsRow = $ui->row()->open();

	$col = $ui->col()->width(8)->open();

		$tabBox1 = $ui->tabBox()
				   ->icon($ui->icon("th"))
				   ->title("Introducing Tabs")
				   ->tab("intro", "How it works", true)
				   ->tab("abouttitle", $ui->icon("plus") . " More about titles")
				   ->tab("settings", $ui->icon('gear'))
				   ->open();
			
			
			$tab1 = $ui->tabPane()->id("intro")->active()->open();
				?>
                <h4>Tabs are awesome - an easy to create.</h4>

                    <p>Tabs behave just like <code>Box</code>es. First, open a <code>tabBox</code> as follows:</p>
<pre>
$myTabBox = $ui->tabBox()
               ->tab("tabPaneId1", "Tab Pane's Title", true) // 'true' means active
               ->tab("tabPaneId2", "Tab Pane Title 1")
               ...
               ->tab("tabPaneIdn", "Tab Pane Title n")
               ->open();
</pre>


					<p>Then, put all the <code>TabPane</code>s. Remember to set proper <code>id</code>s for them.</p>
<pre>
$tab1 = $ui->tabPane()
           ->id("tabPaneId")
           ->open();

    ...
$tab1->close();
</pre>

					<p>Finally, close the <code>TabBox</code>.</p>
<pre>
$myTabBox->close();
</pre>

				<?

			$tab1->close();
			

			$aboutTitleTab = $ui->tabPane()
					   ->id("abouttitle")
					   ->open();
			?>
            	<p>You can have a title and an icon (just like a <code>Box</code>)for the <code>TabBox</code>- or you can skip them.</p>
<pre>
$myTabBox = $ui->tabBox()
			   ->title("The title")
               ->icon($ui->icon("some-icon")
               ...
               ->open();
</pre>

				<p>For the individual <code>TabPane</code>s' titles, you can only have <code>string</code>s. But luckily, you can append an <code>Icon</code> to a <code>string</code>.

<pre>
$myTabBox = $ui->tabBox()
               ->tab("someId1", "String title")
               ->tab("someId2", $ui->icon("some-icon"))
               ->tab("someId3", $ui->icon("some-icon") . " string and icon")
               ...
               
               ->open();
</pre>


            <?
			$aboutTitleTab->close();

			$tab1 = $ui->tabPane()
					   ->id("settings")
					   ->open();
				?><p>This tab just has an <code>Icon</code> as its title. You can also have <code>Input</code>s in the content.</p><?
				
				$ui->input()
				   ->type('text')
				   ->label("A text field")
				   ->show();
				
			$tab1->close();				    
		$tabBox1->close();
		
	$col->close();

	$col = $ui->col()->width(4)->open();
		$tabBox2 = $ui->tabBox()
					  ->tab("t1", "Tab 1")
					  ->tab("t2", "Tab 2")
					  ->tab("t3", "Tab 3", true)
					  ->tab("t4", "Tab 4")
					  ->open();

			$t1 = $ui->tabPane()->id("t1")->active()->open();
				?>
                <p>This <code>TabBox</code> does not have a title. Also, the <strong>Tab 3</strong> is active by default. This is done by setting the third argument to <code>true</code> while adding the tab.</p>
<pre>
$myTabBox = $ui->tabBox()
               ...
               ->tab("t3", "Tab 3", true)
               ->open();
</pre>

<p>Also, make sure that the <code>TabPane</code> has the <code>active()</code> property set.</p>

<pre>
$tab3 = $ui->tabPane()
           ->id("t3")
           ->active()
           ->open();
</pre>

				<?
			$t1->close();

		$tabBox2->close();
	$col->close();

$tabsRow->close();



?><h2 class="page-header">Alerts and callouts</h2><?


$alertsRow = $ui->row()->open();
	$col = $ui->col()->width(6)->open();
		$box = $ui->box()
				  ->title("Alerts")
				  ->icon($ui->icon("exclamation-triangle"))
				  ->open();

			$ui->alert()
			   ->uiType("danger")
			   ->title("Some error occured!")
			   ->desc("An error occured that you might want to know about. Could be important - pay attention!")
			   ->show();

			$ui->alert()
			   ->uiType("info")
			   ->title("Useful information!")
			   ->desc('This alert was created using <code>uiType("info")</code>. Just FYI.')
			   ->show();

			$ui->alert()
			   ->uiType("success")
			   ->title("Success!")
			   ->desc('Alert box created successfully using <code>uiType("success")</code>.')
			   ->show();

			$ui->alert()
			   ->uiType("warning")
			   ->title("I dare you! I double dare you!")
			   ->desc('Use <code>uiType("warning")</code> to create this alert. You have been warned!')
			   ->show();

		?><p>You can make closable alert boxes. Here's how:</p>
<pre>
$box = $ui->alert()
          ->title("...")
          ->desc("...")
          ->uiType("danger")
          ->show();
</pre><?
		$box->close();
	$col->close();

	$col = $ui->col()->width(6)->open();
		$box = $ui->box()
				  ->title("Callouts")
				  ->icon($ui->icon("bullhorn"))
				  ->open();

			$ui->callout()
			   ->uiType("danger")
			   ->title("Some error occured!")
			   ->desc("An error occured that you might want to know about. Could be important - pay attention!")
			   ->show();

			$ui->callout()
			   ->uiType("info")
			   ->title("Useful information!")
			   ->desc('This callout was created using <code>uiType("info")</code>. Just FYI.')
			   ->show();

			$ui->callout()
			   ->uiType("warning")
			   ->title("I dare you! I double dare you!")
			   ->desc('Use <code>uiType("warning")</code> to create this callout. You have been warned!')
			   ->show();

		?><p>You can make callouts. Here's how:</p>
<pre>
$box = $ui->callout()
          ->title("...")
          ->desc("...")
          ->uiType("danger")
          ->show();
</pre><?
		$box->close();
	$col->close();		
$alertsRow->close();


?><?

?><h2 class="page-header">General Elements</h2><?

$buttonsRow = $ui->row()->open();
	$col = $ui->col()->width(7)->open();
		$buttonBox = $ui->box()
				  ->title("Buttons")
		          ->open();
		
			$btnTable = $ui->table()->bordered()->open();
			?>
            <tr>
            	<th>Normal</th>
                <th>Large<br /><code>large()</code></th>
                <th>Mini<br /><code>mini()</code></th>
                <th>Disabled<br /><code>disabled()</code></th>
            </tr>
            <tr>
            	<td><? $ui->button()->value("Default")->show() ?></td>
            	<td><? $ui->button()->value("Default")->large()->show() ?></td>
            	<td><? $ui->button()->value("Default")->mini()->show() ?></td>
            	<td><? $ui->button()->value("Default")->disabled()->show() ?></td>
            </tr>

			<? $btnTypes = array("primary", "success", "info", "danger", "warning") ?>

			<? foreach($btnTypes as $key => $type) { ?>
            <tr>
            	<td><? $ui->button()->value(ucwords($type))->uiType($type)->show() ?></td>
            	<td><? $ui->button()->value(ucwords($type))->uiType($type)->large()->show() ?></td>
            	<td><? $ui->button()->value(ucwords($type))->uiType($type)->mini()->show() ?></td>
            	<td><? $ui->button()->value(ucwords($type))->uiType($type)->disabled()->show() ?></td>
            </tr>
            <? } ?>
            <?
			$btnTable->close();
		$buttonBox->close();
		
		$labelBox = $ui->box()
				  ->title("Labels")
		          ->open();

			?><p>Create labels to show status messages, like the following:</p>

			<p><?
			$ui->label()
			   ->uiType("success")
			   ->text("Complete")
			   ->show();

			echo " ";

			$ui->label()
			   ->uiType("danger")
			   ->text("Rejected")
			   ->show();
			   
			echo " ";
			
			$ui->label()
			   ->uiType("warning")
			   ->text("Pending")
			   ->show();
			
			echo " ";
			   
			$ui->label()
			   ->uiType("info")
			   ->text("Ongoing")
			   ->show();
			?></p>
<pre>
$ui->label()
   ->uiType("info")
   ->text("Ongoing")
   ->show();
</pre>
<?
		$labelBox->close();
	$col->close();

	$col = $ui->col()->width(5)->open();
		$box = $ui->box()
				  ->title("It's easy to create buttons")
				  ->uiType("info")
				  ->solid()
				  ->open();

			$ui->callout()
			   ->uiType("info")
			   ->desc('You can also set the <code>id</code>, <code>name</code> and other attributes. ' . 
			   		  'See the <a href="http://172.16.8.5/wiki/index.php/UI_Library">wiki</a> for full details.')
			   ->show();
	  
?>
<p>Here's how you create a basic button. Use the properties shown to style the buttons:
<pre>
$ui->button()
   ->value("Some text")
   ->uiType("someType")
   ->show();
</pre>

<h4>A <code>block()</code> button</h4>
<p>A block button spans the whole box (or the parent):</p>
<? 
			$ui->button()
			   ->value("Block button")
			   ->block()
			   ->show();

			$ui->button()
			   ->value("Large block primary button")
			   ->block()
			   ->large()
			   ->uiType("primary")
			   ->show();
?>
<h4>Button with an <code>icon()</code></h4>
<p>Add an icon to the button using the <code>icon()</code> property:</p>
<pre>
$ui->button()
   ...
   ->icon($ui->icon('some-icon'))
   ->show();
</pre>
<? 
			$ui->button()
			   ->value("Edit")
			   ->icon($ui->icon('pencil'))
			   ->show();

			echo ' ';

			$ui->button()
			   ->value("Delete")
			   ->uiType("danger")
			   ->icon($ui->icon('trash-o'))
			   
			   ->show();

		$box->close();
	$col->close();
$buttonsRow->close();


?>
<h2 class="page-header">Tables</h2>
<?

$row = $ui->row()->open();
	$col = $ui->col()->open();
			$ui->callout()
			   ->uiType("warning")
			   ->desc('<strong>Do not use tables to display forms</strong>, or other data that doesn\'t look like a table. Use tables to <strong>only</strong> show tabular data. <a href="https://www.google.co.in/search?q=why+shouldn\'t+we+use+tables" target="_blank">Here\'s why!</a>')
			   ->show();
	$col->close();
$row->close();

$tablesRow = $ui->row()->open();
	$col = $ui->col()->width(8)->open();
		$box = $ui->box()
				  ->title("Simple tables")
				  ->open();


?>

<p>You can use different combinations of the following options to create <code>Table</code>s:</p>
<pre>
$table = $ui->table()
            ->hover()
            ->bordered()
            ->striped()
            ->responsive()
            ->condensed()
            ->open();
    ...
$table->close();
</pre>
<?

			$table = $ui->table()->hover()->bordered()->open();
			
			echo '<tbody>
						<tr>
							<th>ID</th>
							<th>User</th>
							<th>Date</th>
							<th>Status</th>
							<th>Reason</th>
						</tr>
						<tr>
							<td>183</td>
							<td>John Doe</td>
							<td>11-7-2014</td>
							<td><span class="label label-success">Approved</span></td>
							<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
						</tr>
						<tr>
							<td>219</td>
							<td>Jane Doe</td>
							<td>11-7-2014</td>
							<td><span class="label label-warning">Pending</span></td>
							<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
						</tr>
						<tr>
							<td>657</td>
							<td>Bob Doe</td>
							<td>11-7-2014</td>
							<td><span class="label label-primary">Approved</span></td>
							<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
						</tr>
						<tr>
							<td>175</td>
							<td>Mike Doe</td>
							<td>11-7-2014</td>
							<td><span class="label label-danger">Denied</span></td>
							<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
						</tr>
					</tbody>';
			$table->close();
		$box->close();
	$col->close();
	
	$col = $ui->col()->width(4)->open();
		$box1 = $ui->box()->title('Data Tables')->solid()->uiType('primary')->open();
?>
<p>You can make tables searchable and sortable. You can also add pagination to the tables. Just set any of the 3 properties you want.</p>
<pre>
$myDataTable = $ui->table()
                  ...
                  ->sortable()
                  ->searchable()
                  ->paginated()
                  ->open();
</pre>
<?
		$box1->close();
	$col->close();
$tablesRow->close();

$dataTablesRow = $ui->row()->open();
	$col = $ui->col()->open();
		$box1 = $ui->box()->title('All employees in Indian School of Mines')->id("usersBox")->open();
	
			$ui->callout()
		   ->uiType("info")
		   ->desc('This example asynchronously loads the data for all users in ISM. View the source to see how it works.')
		   ->show();
			
			$myDataTable = $ui->table()
							  ->id('usersTable')
							  ->bordered()
							  ->striped()
							  ->sortable()
							  ->searchable()
							  ->paginated()
							  ->open();
?>
		<thead>
            <tr>
                <th>User ID</th>
                <th>Salutation</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Department Name</th>
            </tr>
		</thead>

        <tfoot>
            <tr>
                <th>User ID</th>
                <th>Salutation</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Department Name</th>
            </tr>
        </tfoot>
<?
			$myDataTable->close();
			$box1->close();
	$col->close();
$dataTablesRow->close();


?><h2 class="page-header">Form Elements</h2><?


$formRow = $ui->row()->open();

	$col = $ui->col()->width(8)->open();
		$box = $ui->box()
				  ->title("General Elements")
				  ->open();

			$ui->callout()
			   ->uiType("info")
			   ->desc("See wiki for a detailed explanation of creating each type of element.")
			   ->show();


			$ui->input()->type("text")->label("Text")->placeholder("Text")->show();
			$ui->input()->type("text")->label("A textbox with help")->placeholder("Text")->help("Some help text goes here")->show();

			$ui->input()->type("text")->label("Text Disabled")->placeholder("Text Disabled")->disabled()->show();

			$ui->textarea()->label("Textarea")->placeholder("Textarea")->show();

			$ui->input()->type("text")->label("Input with success")->placeholder("Enter text")->uiType("success")->show();
			$ui->input()->type("text")->label("Input with warning")->placeholder("Enter text")->uiType("warning")->show();
			$ui->input()->type("text")->label("Input with error")->placeholder("Enter text")->uiType("error")->show();

			$ui->checkbox()->label("Checkbox")->show();
			$ui->checkbox()->label("Disabled Checkbox")->disabled()->show();

			$ui->radio()->label("Radio button")->name("sampleRadio")->checked()->show();
			$ui->radio()->label("Another Radio Button")->name("sampleRadio")->show();

			$ui->select()
				->label('Select Box')
				->name('select_box')
				->options(array($ui->option()->value('0')->text('Select')->disabled(),
								$ui->option()->value('1')->text('One'),
								$ui->option()->value('2')->text('Two'),
								$ui->option()->value('3')->text('Three'),
								$ui->option()->value('4')->text('Four')->selected(),
								$ui->option()->value('5')->text('Five')))
				->show();

			$sampleOptions = array($ui->option()->value('0')->text('Select')->disabled(),
								$ui->option()->value('1')->text('One'),
								$ui->option()->value('2')->text('Two'),
								$ui->option()->value('3')->text('Three'),
								$ui->option()->value('4')->text('Four')->selected(),
								$ui->option()->value('5')->text('Five'));

			$ui->select()
				->label('Multiple Select Box')
				->name('multiple_select_box')
				->multiple()
				->options($sampleOptions)
				->show();
		
			$ui->imagePicker()->label("An image picker")->show();	
			
			$ui->datePicker()->label("A date picker")->show();	
			
			$ui->timePicker()->label("A time picker")->show();

			$ui->slider()
				->id('slider2')
				->min('0')
				->label('A slider')
				->max('100')
				->step('1')
				->grid()
				->value("15")
				->show();

			$ui->slider()
				->id('slider1')
				->label('A ranged slider')
				->min('0')
				->max('50000')
				->step('100')
				->rangeType()
				->dataFrom('9000')
				->dataTo('20000')
				->prefix('$')
				->show();		
?>
<p>To create input elements with smaller widths, create a <code>Row</code> and place the inputs inside it with their <code>width()</code> property:</p>
<pre>
$inputsRow = $ui->row()->open();
    $ui->input()->type("text")->...->width(2)->show();
    $ui->select()->...->width(4)->show();
    $ui->input()->...->width(6)->show();
$inputsRow->close();
</pre>
<?
			$textRow = $ui->row()->open();
				$ui->input()->type("text")->label("Small")->placeholder("Enter text")->width(2)->show();
				$ui->select()->label("Medium")->placeholder("Enter text")->width(4)->options($sampleOptions)->show();
				$ui->input()->type("text")->label("Large input")->placeholder("Enter text")->width(6)->show();
			$textRow->close();

		$box->close();
	$col->close();


	$col = $ui->col()->width(4)->open();
		$box = $ui->box()
				  ->title("Quick example")
				  ->uiType("info")
				  ->solid()
				  ->open();
				  
			$quickForm = $ui->form()
							->action("#")
							->open();

?>
<pre>
$ui->input()
   ->type("someType")
   ->label("A label")
   ->placeholder("A nice placeholder")
   ->name("someName")
   ->id("someId")
   ->required()
   ->show();	
</pre>
<?			  
				  $ui->input()
				     ->type("text")
					 ->label("Username")
					 ->placeholder("Enter your username")
					 ->name("username")
					 ->show();

				  $ui->input()
				     ->type("password")
					 ->label("Password")
					 ->placeholder("Enter your password")
					 ->name("password")
					 ->show();	

				  ?><hr /><?				
				  $ui->button()
				     ->submit()
					 ->value("Submit")
					 ->large()
					 ->uiType("primary")
					 ->show();

				  $ui->checkbox()
				     ->label("Remember me")
					 ->width(6)
					 ->checked()
					 ->show();

			$quickForm->close();
				  
		$box->close();
		
		$box = $ui->box()
				  ->title("Addons")
				  ->uiType("info")
				  ->solid()
				  ->open();
				  
?>
<p>You can add <code>Button</code>s, <code>Icon</code>s or plain texts as an addon to the left or right (or both) as follows:</p>
<pre>
$ui->input()
   ->...
   ->addonLeft('someAddon')
   ->addonRight('someAddon')
   ->show();
</pre>
<?
		  $ui->input()
			 ->type("text")
			 ->label("Textbox with button addon.")
			 ->placeholder("Enter some text")
			 ->addonRight($ui->button()->value("Go")->uiType("primary"))
			 ->show();

		  $ui->select()
			 ->label("Select with left icon addon, and right text addon.")
			 ->options($sampleOptions)
			 ->addonLeft($ui->icon("usd"))
			 ->addonRight(".00")
			 ->show();

		  $ui->datePicker()
			 ->label("Date with left icon addon, right button addon")
			 ->addonLeft($ui->icon("calendar"))
			 ->addonRight($ui->button()->value("Choose")->uiType("success"))
			 ->uiType("success")
			 ->id("dpAddon")
			 ->value("01-05-2014")
			 ->show();
			 
		  $ui->timePicker()
			 ->label("Time with left icon addon, right button addon")
			 ->addonLeft($ui->icon("clock-o"))
			 ->addonRight($ui->button()->value("Choose")->uiType("success"))
			 ->uiType("success")
			 ->id("tpAddon")
			 ->value("11:49 AM")	//same as defaultTime("11:49 AM")
			 ->showMeridian('true')
			 ->showSeconds('true')
			 ->secondStep(10)
			 ->minuteStep(2)
			 ->show();

		$box->close();
	$col->close();
$formRow->close();
