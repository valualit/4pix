<template>
		<div>
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					
				</div>
			</div><!-- /.container-fluid -->
		</section>
		
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 card">
						<div class="card-header">
							<h3 class="card-title"></h3>
							<router-link :to="{name:'AdminDepartmentsAdd'}" class="btn btn-success btn-sm">Add department</router-link>
							<div class="card-tools">
								<ul class="pagination pagination-sm float-right">
									<li v-if="links.length>0" v-for="page in links" v-on:click="loadData(page)" :class="{ active: page===currentPage}" class="page-item"><a class="page-link" href="javascript://">{{page}}</a></li>
								</ul>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive p-0">
						<table class="table table-head-fixed">
							<thead>
								<tr>
									<th class="d-none d-sm-table-cell" style="width: 10px">#</th>
									<th style="width: 20px"></th>
									<th>Logo</th>
									<th>Name / Description</th>
									<th>Users</th>
									<th>Create</th>
								</tr>
							</thead>
							<tbody>
							<tr v-if="departments.length>0" v-for="department in departments">
								<td class="d-none d-sm-table-cell">{{ department.num }}.</td>
								<td>
									<div class="btn-group">
										<a href="javascript://" v-on:click="DepartmentDelete(department.id)" class="btn btn-tool dropdown-item" title="Delete"><i class="fas fa-trash"></i></a>
										<router-link :to="{name:'AdminDepartmentsEdit', params: { id: department.id }}" class="btn btn-tool dropdown-item" title="Edit"><i class="fas fa-edit"></i></router-link>
									</div> 
								</td>
								<td><img v-if="department.logo!=null" :src="department.logo" alt="" class="mt-2" style="max-width:120px" /></td>
								<td>
									<b>{{ department.name }}</b>
									<p>{{ department.description }}</p>
								</td>
								<td>
									<small v-if="department.users.length>0" v-for="user in department.users" class="d-block">
										<i class="fas fa-user"></i> {{user}}
									</small>
								</td>
								<td>{{ department.created }}</td>
							</tr>
							</tbody>
						</table>
						</div>
					<!-- /.card-body -->
					</div>
				</div>
			<!-- /.row -->
			</div><!-- /.container-fluid -->
		</section>
	</div>
</template>

<script>
    export default {
        mounted() {
			this.loadData();
        },
		methods: {
            loadData: function(page = 0) {
				if(page==0){
					if(this.$route.query.page !== undefined){
						page = this.$route.query.page;
					} else {
						page = 1;
					}
				}
				if(this.currentPage!=page){
					this.$router.replace({query:{page:page}});
				}
				axios.get(this.$router.resolve({name: 'AdminDepartmentsAjaxGetList'}).href + '?page='+ page).then((response)=>{
					if(response.status==200){
						this.departments=response.data.departments;
						this.links=response.data.links;
						this.currentPage=response.data.currentPage;
						this.total=response.data.total;
						this.lastPage=response.data.lastPage;
					}
				}).catch(err=>{
					console.log(err)
				});
            },  
            DepartmentDelete: function(DepartmentID) {
				if(confirm("Do you really want to delete?")){
					axios.post(this.$router.resolve({name: 'AdminDepartmentsDelete'}).href, {
						id: DepartmentID
					}).then((response)=>{
						if(response.data.status == 'error'){
							alert(response.data.errors); 
						} else {
							this.loadData();
						}
					}).catch(err=>{
						console.log(err)
					}); 
				}
			}
        },  
		data : function () {
            return {
                departments:[],
                links:[],
                currentPage:this.$route.query.page,
                total:1,
                lastPage:1,
                pagination:[],
            }
        },
    }
</script>
 