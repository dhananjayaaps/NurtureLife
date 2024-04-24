# NurtureLife

most important attributes to display of a user
1.User ID
1. Name
2. Email
3. status
4. contact_no
5. role


<!--js to populate the notification container-->
<script>
    //TODO: consider currently logged-in user's postal code and display notifications accordingly
    //var volunteer_zip = <?php //echo Application::$app->user->getZip()?>//;
    //var local_user_data = <?php //echo $user_model->getUsersByZip(volunteer_zip)?>//;
    // var postData = $post_model->getPosts();

    function displayPosts() {
        var postBox = document.getElementById('myBox');
        postBox.innerHTML = '';

        for (var i = 0; i < postData.length; i++) {
            var post = postData[i];
            var newPost = document.createElement('div');
            newPost.className = 'post';
            newPost.innerHTML = `
            <div class="post-header">
                <span class="user-name">${post.userName}</span> - <span class="role-name">${post.roleName}</span>
            </div>
            <div class="post-description">
                ${post.description}
            </div>
            <div class="post-footer">
                <div class="dates">
                    <span class="created-date">${post.created_at}</span>
                    <span class="updated-date">${post.updated_at}</span>
                </div>
                <div class="status">
                    ${post.status}
                </div>
                <div class="actions">
                    <button class="attend-button" onclick="attendPost(${post.id})">Attend</button>
                </div>
            </div>
        `;
            postBox.appendChild(newPost);
        }
    }

    // Call the function to display the posts
    displayPosts();

</script>