## USER ROLES AND CREDENTIALS

#### Admin
* username : JonDoe
* password : 123123

#### Manager
* username : jane_doe
* password : 123123

#### Regular User
* username : JuneDoe
* password : 123123

## SERVE THE PROJECT

`php -S localhost:8000`

## URL ENDPOINTS AND ACCESSIBILITY

#### Accessible to all
* <http://localhost:8000/>

#### Accessible to unauthenticated users
* <http://localhost:8000/register/>
* <http://localhost:8000/login/>

#### Accessible to all authenticated users
* <http://localhost:8000/profile/>
* <http://localhost:8000/user-area/>
* <http://localhost:8000/logout/>

#### Accessible to managers and admins
* <http://localhost:8000/manager-area/>

#### Accessible to admins only
* <http://localhost:8000/admin-area/>
* <http://localhost:8000/manage-user-role/{userId}>
