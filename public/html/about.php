<div>
<br>This Web App Perform the following 
<h4>Users</h4>
<ul>
    <li> Users can view a list of readers or authors</li>
    <li> Readers cannot create new posts</li>
</ul>
<h4>Posts</h4>
<ul>
	<li> Posts can be created, updated and deleted by owner</li>
	<li> Posts can be read by anyone</li>
	<li> Posts can be commented on</li>
</ul>
<h4> Comments </h4>
<ul>
	<li> Newly created comments by poster appear without post page without reloading</li>
	<li> Comments can be updated and deleted by comment author</li>
	<li> Comments can be deleted by authors</li>
</ul>
<h4> Blog</h4>
<ul>
	<li> Displays a list of all posts, categorized by date<li>
</ul>
</div>

<div id=myTab role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Blog</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">Displays a list of all posts, categorized by date</div>
    <div role="tabpanel" class="tab-pane" id="profile">...</div>
    <div role="tabpanel" class="tab-pane" id="messages">...</div>
    <div role="tabpanel" class="tab-pane" id="settings">...</div>
  </div>

</div>
<script>
$('#myTab a[href="#profile"]').tab('show') // Select tab by name
$('#myTab a:first').tab('show') // Select first tab
$('#myTab a:last').tab('show') // Select last tab
$('#myTab li:eq(2) a').tab('show') // Select third tab (0-indexed)
</script>