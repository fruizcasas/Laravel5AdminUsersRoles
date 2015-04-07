# Laravel5AdminUsersRoles

My foundation to develop Laravel 5 applications using Bootstrap 3 

The Applications uses two main things
 
*An <strong>Admin</strong> middleware

    The flag $user->is_admin in the user allows the access to the Admin Middleware
    
    The middleware redirects to /home for not allowed users
    
    Inside you can edit Users,Roles & Permissions

    Routes: /admin/users
            /admin/roles
            /admin/permissions
            
            
    
*<strong>Zizaco/Entrust</strong>
 
   Documentation for the Package can be found on 
   
   [https://github.com/Zizaco/entrust](https://github.com/Zizaco/entrust).

#Models

 Two classes of models are availiables
 
 In the Admin middleware models space:
 
    User/Role/Permission Admin\Models associated to the Admin/Controllers (Eloquent Models)
 
    They are used to manage the data base throw the Admin/CRUD
   
 In the App models space 
   
    User/Role/Permission  (Entrust Models)
    
#CRUD Ide
 The basis for the CRUD model is the index view. 
 
 You browse the records of the table with permanent filtering stored in the profile model on the database.
 On Echa login you restore the filters for each view.
  
 The soft delete models incorpore three operations:
  <ul>
    <li>Trash</li>
    <li>Restore</li>
    <li>Delete</li>
  </ul>  
 
 In the Show view you have Edit/Trash or Restore/Delete buttons depending of <strong>trashed()</strong> for each model.
 
 You have also multicolunm sorting (Asc/Desc) in order to have a fiendly interface.
 
 The CRUD views are built using common includes placing the buttons is a convenient way.
 
 You have also breadcrumbs for an easy operation.
 
 Also the profile stores the bootstrap theme option get from [https://bootswatch.com](https://bootswatch.com)
 
 Show the trashed() items in the index view is algo optional with a Show/Hide trash button.
 

# The schema is the next
    * Users (SoftDeletes)
        id
        name
        email (unique)
        password
        is_admin  (AdminAuthentication Middleware)
        ...
        timestamps()
    * Roles(SoftDeletes)
        id
        name
        display_name
        description
        acronym
        timestamps()
        
    * RoleUser(Pivot table,SoftDeletes)
        role_id
        user_id
        timestamps()
        
    *Permissions(SoftDeletes)        
        id
        name
        display_name
        description
        timestamps()
        
    * RolePermision(Pivot table,SoftDeletes)
        role_id
        permision_id
        timestamps()
        
        
        
