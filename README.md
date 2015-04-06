# Laravel5AdminUsersRoles
My foundation to develop Laravel 5 Applications Bootstrap 3 
# The schema is the next
    * Users (SoftDeletes)
        id
        name
        email (unique)
        password
        timestamps
        is_admin
    * Roles(SoftDeletes)
        id
        name
        display_name
        description
        acronym
    * RoleUser(Pivot table)
        role_id
        user_id
        timestamps
        
        
        
        
