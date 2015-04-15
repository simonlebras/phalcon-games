<div class="manage">
    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>Login</th>
            <th>Creation date</th>
            <th>Email</th>
            <th>Avatar</th>
            <th>Delete</th>
        </tr>
        {% for account in accounts %}
            <tr id={{ account.id }}>
                <td>{{ account.login }}</td>
                <td>{{ date('d/m/Y', strtotime(account.account_creation)) }}</td>
                <td>{{ account.email }}</td>
                <td>{{ image(account.file, 'avatar') }}</td>
                <td>
                    <button class="btn btn-danger btn-lg" data-id={{ account.id }}>Delete</button>
                </td>
            </tr>
        {% endfor %}
    </table>
</div>