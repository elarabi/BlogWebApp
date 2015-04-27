 <div class="well main-container">
    <h3>Post Details</h3>
    <hr style="color:#eee;">
    <form name="articleDetailsForm">
        <div class="row">
            <div class="col-lg-7 ">
                <div class="input-group ">
                    <label class="input-label">Write By</label>
                    <input type="hidden" ng-model="article.Details.author">
                    <select aria-label="Article-Writer" placeholder="Write by" class="input-element-lg">
                     <option>N/S</option>
                     <option ng-repeat="usr in users  | filter:{role:'writer'}:true " ng-selected="usr.id == article.Details.author">{{usr.name}}-{{usr.role}}</option>
                   </select>
                </div>
            </div>
            <div class="col-lg-5 ">
                <div class="input-group">
                    <label>Published On</label>
                    <input type="text" name="publishedon" data-ng-model="article.Details.publishedon" class="input-element-date"readOnly>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="input-group ">
                    <label>Title</label>
                    <input type="text" class="input-element-lg" data-ng-model="article.Details.title" name="title" required>
                </div>
        </div>
        <div class="row">
            <div class="input-group">
                <label>Description</label>
                <textarea name="contents"  data-ng-model="article.Details.contents" class="input-element-lg" cols="60" rows="10" required></textarea>
            </div>
        </div>
        <br>
        <footer>
            <div class="row" data-ng-show="user.isWriter()">
                <button data-ng-click="article.add()" data-ng-hide="user.isOwner(article.Details)" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-save"></i>Add</button>
                <button data-ng-click="article.edit()" data-ng-show="user.isOwner(article.Details)" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i>Edit</button>
                <button data-ng-click="article.del()" data-ng-show="user.isOwner(article.Details)" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>Delete</button>
                <button data-ng-click="article.clear()" class="btn btn-warning" type="reset"><i class="glyphicon glyphicon-erase"></i>Cancel</button>
            </div>
        </footer>
</form>

</div>
