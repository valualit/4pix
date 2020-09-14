import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter)

const AdminPath = '/admin/';

import AdminUsersList from '@/js/components/admin/Users/list';
import AdminUsersEdit from '@/js/components/admin/Users/edit';
import AdminDepartmentsList from '@/js/components/admin/Departments/list';
import AdminDepartmentsEdit from '@/js/components/admin/Departments/edit';

const router = new VueRouter({
	mode: 'history',
	routes: [
		// PAGE
		{path: '/', name: 'Home', component: AdminUsersList},
		{path: AdminPath, name: 'AdminHome', component: AdminUsersList},
		// Admin users
		{path: AdminPath+'Users/', name: 'AdminUsersList', component: AdminUsersList, props: true}, 
		{path: AdminPath+'Users/add', name: 'AdminUsersAdd', component: AdminUsersEdit}, 
		{path: AdminPath+'Users/:id/edit', name: 'AdminUsersEdit', component: AdminUsersEdit, props: true}, 
		{path: AdminPath+'Users/delete', name: 'AdminUsersDelete'}, 
		// AJAX 
		{path: AdminPath+'Users/AjaxGetList/', name: 'AdminUsersAjaxGetList'},  
		{path: AdminPath+'Users/getUserInfo/', name: 'AdminUsersAjaxGetUserInfo'},  
		// Admin Departments
		{path: AdminPath+'Departments/', name: 'AdminDepartmentsList', component: AdminDepartmentsList, props: true}, 
		{path: AdminPath+'Departments/add', name: 'AdminDepartmentsAdd', component: AdminDepartmentsEdit}, 
		{path: AdminPath+'Departments/:id/edit', name: 'AdminDepartmentsEdit', component: AdminDepartmentsEdit, props: true}, 
		{path: AdminPath+'Departments/delete', name: 'AdminDepartmentsDelete'}, 
		// AJAX
		{path: AdminPath+'Departments/AjaxGetDepartmentUser', name: 'AjaxGetDepartmentUser'}, 
		{path: AdminPath+'Departments/AjaxGetList/', name: 'AdminDepartmentsAjaxGetList'},  
		{path: AdminPath+'Departments/getDepartmentInfo/', name: 'AdminDepartmentsAjaxGetDepartmentInfo'},   
	]
}); 

export default router;