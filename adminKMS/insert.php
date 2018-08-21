<form action="insert_news_event.php" method="post" name="add">
  <fieldset>
    <label for="skill">
      Skill:
    </label>
    <!-- skill here -->
    <label for="name">Name:</label>
    <input id="new-event" type="text" class="form-control" placeholder="Type your name here...">
    <label for="name">News:</label>
    <input id="new-event" type="text" class="form-control" placeholder="News Title">
    <label for="name">Description:</label>
    <input id="new-event" type="text" class="form-control" placeholder="Type the description here...">
    <label for="name">Picture: </label>
    <input type="file" name="img" multiple>
  </fieldset>
  </br>

  <div>
    <button  type="submit" id="add-new-event" class="btn btn-primary btn-flat" name="add_news">Add</button>
  </div><!-- /no more btn-group -->
</form>
