<div class="tab-content">
    <div id="college-course" class="tab-pane active">
        <h3 class="section-title">College Course Management</h3>
        
        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
            <button style="background: var(--primary-color); color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New Course
            </button>
            
            <div style="display: flex; gap: 10px;">
                <select style="padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                    <option>Filter by Department</option>
                    <option>Computer Science</option>
                    <option>Mathematics</option>
                    <option>Engineering</option>
                </select>
                <input type="text" placeholder="Search courses..." style="padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
            </div>
        </div>
        
        <div class="dashboard-cards" style="margin-bottom: 20px;">
            <div class="card">
                <div class="card-header">
                    <div>
                        <div class="card-title">Total Courses</div>
                        <div class="card-value">42</div>
                    </div>
                    <div class="card-icon users">
                        <i class="fa fa-book" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div>
                        <div class="card-title">Active Courses</div>
                        <div class="card-value">36</div>
                    </div>
                    <div class="card-icon orders">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div>
                        <div class="card-title">Enrolled Students</div>
                        <div class="card-value">1,245</div>
                    </div>
                    <div class="card-icon revenue">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <table class="recent-orders">
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Department</th>
                    <th>Instructor</th>
                    <th>Students</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>CS101</td>
                    <td>Introduction to Programming</td>
                    <td>Computer Science</td>
                    <td>Dr. Smith</td>
                    <td>142</td>
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