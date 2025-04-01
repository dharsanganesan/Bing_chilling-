<div class="tab-content">
    <div id="points-edit" class="tab-pane active">
        <h3 class="section-title">Points Management</h3>
        
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-header">
                <div>
                    <div class="card-title">Points System Overview</div>
                    <div class="card-value" style="font-size: 16px;">Manage student points and rewards</div>
                </div>
                <button style="background: var(--primary-color); color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">
                    <i class="fa fa-cog" aria-hidden="true"></i> Configure Rules
                </button>
            </div>
        </div>
        
        <div class="dashboard-cards" style="margin-bottom: 20px;">
            <div class="card">
                <div class="card-header">
                    <div>
                        <div class="card-title">Total Points Awarded</div>
                        <div class="card-value">24,573</div>
                    </div>
                    <div class="card-icon users">
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div>
                        <div class="card-title">Active Students</div>
                        <div class="card-value">824</div>
                    </div>
                    <div class="card-icon orders">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div>
                        <div class="card-title">Avg. Points/Student</div>
                        <div class="card-value">29.8</div>
                    </div>
                    <div class="card-icon revenue">
                        <i class="fa fa-calculator" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
            <button style="background: var(--primary-color); color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                <i class="fa fa-plus" aria-hidden="true"></i> Award Points
            </button>
            
            <div>
                <input type="text" placeholder="Search students..." style="padding: 10px; border: 1px solid #ddd; border-radius: 5px; width: 300px;">
            </div>
        </div>
        
        <table class="recent-orders">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Total Points</th>
                    <th>Last Award</th>
                    <th>Badges</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#STU-1001</td>
                    <td>John Smith</td>
                    <td>428</td>
                    <td>May 15, 2023</td>
                    <td>
                        <span style="background-color: #ffd700; color: #856404; padding: 3px 8px; border-radius: 10px; font-size: 12px;">Gold</span>
                        <span style="background-color: #c0c0c0; color: #333; padding: 3px 8px; border-radius: 10px; font-size: 12px; margin-left: 5px;">Silver</span>
                    </td>
                    <td>
                        <i class="fa fa-edit" aria-hidden="true" style="cursor: pointer; margin-right: 10px;"></i>
                        <i class="fa fa-history" aria-hidden="true" style="cursor: pointer; margin-right: 10px;"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>