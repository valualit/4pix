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
							<router-link :to="{name:'AdminUsersAdd'}" class="btn btn-success btn-sm">Add user</router-link>
							<div class="card-tools">
								<ul class="pagination pagination-sm float-right">
									<li v-if="links.length>0" v-for="page in links" v-on:click="loadData(page)" :class="{ active: page===currentPage}" class="page-item"><a class="page-link" href="javascript://">{{page}}</a></li>
								</ul>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive p-0">
						<table class="table table-head-fixed text-nowrap">
							<thead>
								<tr>
									<th class="d-none d-sm-table-cell" style="width: 10px">#</th>
									<th style="width: 20px"></th>
									<th>Name</th>
									<th>Email</th>
									<th>Create</th>
								</tr>
							</thead>
							<tbody>
							<tr v-if="users.length>0" v-for="user in users">
								<td class="d-none d-sm-table-cell">{{ user.num }}.</td>
								<td>
									<div class="btn-group">
										<a href="javascript://" v-on:click="UserDelete(user.id)" class="btn btn-tool dropdown-item" title="Delete"><i class="fas fa-trash"></i></a>
										<router-link :to="{name:'AdminUsersEdit', params: { id: user.id }}" class="btn btn-tool dropdown-item" title="Edit"><i class="fas fa-edit"></i></router-link>
									</div> 
								</td>
								<td><a href=""><b>{{ user.name }}</b></a></td>
								<td>{{ user.email }}</td>
								<td>{{ user.created }}</td>
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
				axios.get(this.$router.resolve({name: 'AdminUsersAjaxGetList'}).href + '?page='+ page).then((response)=>{
					if(response.status==200){
						this.users=response.data.users;
						this.links=response.data.links;
						this.currentPage=response.data.currentPage;
						this.total=response.data.total;
						this.lastPage=response.data.lastPage;
					}
				}).catch(err=>{
					console.log(err)
				});
            },  
            UserDelete: function(user) {
				if(confirm("Do you really want to delete?")){
					axios.post(this.$router.resolve({name: 'AdminUsersDelete'}).href, {
						id: user
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
                users:[],
                links:[],
                currentPage:this.$route.query.page,
                total:1,
                lastPage:1,
                pagination:[],
            }
        },
    }
</script>
