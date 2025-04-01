<div class="tab-content">
    <div id="users" class="tab-pane active">
        <h3 class="section-title">User Management</h3>
        
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-header">
                <div>
                    <div class="card-title">Search and Filter Users</div>
</div>
            </div>
            <div style="padding: 15px;">
                <input type="text" placeholder="Search users..." style="padding: 8px; width: 100%; max-width: 400px; border: 1px solid #ddd; border-radius: 5px;">
            </div>
        </div>
        
        <table class="recent-orders">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Joined</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#USR-1001</td>
                    <td>John Smith</td>
                    <td>john@example.com</td>
                    <td>Student</td>
                    <td>Jan 15, 2023</td>
                    <td><span class="status completed">Active</span></td>
                    <td>
                        <i class="fa fa-edit" aria-hidden="true" style="cursor: pointer; margin-right: 10px;"></i>
                        <i class="fa fa-trash" aria-hidden="true" style="cursor: pointer; color: var(--danger-color);"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>