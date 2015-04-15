<div class="guestbook">
    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>Login</th>
            <th>Post date</th>
            <th>Content</th>
            <th>Delete</th>
        </tr>
        {% for post in posts %}
            <tr id={{ post.id }}>
                <td>{{ post.getAccount().login }}</td>
                <td>{{ date('d/m/Y', strtotime(post.date_comment)) }}</td>
                <td class="content">{{ post.comment |  striptags}}</td>
                <td>
                    <button class="btn btn-danger btn-lg" data-id={{ post.id }}>Delete</button>
                </td>
            </tr>
        {% endfor %}
    </table>
</div>