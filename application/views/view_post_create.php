<div id="content">
    <div class="panel panel-default">
        <div class="panel-body">
            <div id="create_post_content">
                <h1>Creating new post</h1>
                <form enctype="multipart/form-data" method="post" action="/Post/Add">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="postText">Text</label>
                        <textarea class="form-control" id="postText" name="postText" rows="20" wrap="hard"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" id="input" name="image">
                    </div>
                    <button type="submit" class="btn btn-danger">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>