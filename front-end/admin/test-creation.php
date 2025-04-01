<div class="tab-content">
    <div id="test-creation" class="tab-pane active">
        <h3 class="section-title">Test Creation</h3>
        
        <div class="dashboard-cards" style="margin-bottom: 20px;">
            <div class="card">
                <div class="card-header">
                    <div>
                        <div class="card-title">Total Tests</div>
                        <div class="card-value">42</div>
                    </div>
                    <div class="card-icon users">
                        <i class="fa fa-file-text" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div>
                        <div class="card-title">Active Tests</div>
                        <div class="card-value">28</div>
                    </div>
                    <div class="card-icon orders">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div>
                        <div class="card-title">Questions</div>
                        <div class="card-value">356</div>
                    </div>
                    <div class="card-icon revenue">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
           <a href="#"><button style="background: var(--primary-color); color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
            <i class="fa fa-plus" aria-hidden="true"></i> Create New Test
            </button></a>
            
            <div>
                <select style="padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                    <option>Filter by Subject</option>
                    <option>Mathematics</option>
                    <option>Science</option>
                    <option>History</option>
                </select>
            </div>
        </div>
        
        <table class="recent-orders">
            <thead>
                <tr>
                    <th>Test ID</th>
                    <th>Test Name</th>
                    <th>Subject</th>
                    <th>Questions</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#TST-2001</td>
                    <td>Algebra Basics</td>
                    <td>Mathematics</td>
                    <td>20</td>
                    <td>30 mins</td>
                    <td><span class="status completed">Active</span></td>
                    <td>
                        <i class="fa fa-edit" aria-hidden="true" style="cursor: pointer; margin-right: 10px;"></i>
                        <i class="fa fa-eye" aria-hidden="true" style="cursor: pointer; margin-right: 10px;"></i>
                        <i class="fa fa-trash" aria-hidden="true" style="cursor: pointer; color: var(--danger-color);"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>