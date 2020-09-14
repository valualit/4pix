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
							<router-link :to="{name:'AdminUsersList'}" class="btn btn-success btn-sm">Back</router-link>
							<div class="card-tools">
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive p-2">
							<form method="POST" class="" enctype="multipart/form-data">
								<div v-if="Object.keys(validationErrors).length>0" class="m-2"> 
									<ul class="alert alert-danger">
										<li v-for="error in validationErrors">{{ error }}</li>
									</ul>
								</div>
								<div class="container-fluid mt-1">
									<div class="row">
										<div class="form-group col-12">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">@</span>
												</div> 
												<input type="text" class="form-control" v-model="name" placeholder="Name" required /> 
											</div>
										</div> 
										<div class="form-group col-12">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-envelope"></i></span>
												</div> 
												<input type="text" class="form-control" v-model="email" placeholder="E-Mail" required />
											</div>
										</div> 
										<div class="form-group col-12">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-key"></i></span>
												</div> 
												<input type="password" class="form-control" v-model="password" placeholder="Password" required />
											</div>
										</div>
									</div>
									<div class="text-center">
										<button  @click="submitForm" type="button" class="btn btn-success btn-sm">{{textButton}}</button >
									</div>
								</div>
							</form>
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
			if(this.$route.params.id !== undefined){
				this.idUser = this.$route.params.id;
				this.textButton = 'Edit user';
				axios.post(this.$router.resolve({name: 'AdminUsersAjaxGetUserInfo'}).href, {
					id: this.idUser,
				}).then((response)=>{
					if(response.data.status == 'done'){
						this.name = response.data.name;
						this.email = response.data.email;
					} else {
						// this.$router.push(this.$router.resolve({name: 'AdminUsersList'}).href);
					}
				}).catch(error  => { 
					console.log(error);  
				});
			}
        },
		methods: {
            submitForm: function() {
				let url  = this.$router.resolve({name: 'AdminUsersAdd'}).href;
				let data = {
					name: this.name, 
					email: this.email,
					password: this.password,
				};
				if(this.idUser > 0 ){
					url  = this.$router.resolve({name: 'AdminUsersEdit', params: { id: this.idUser }}).href;
					data.id = this.idUser;
				}
				axios.post(url, data).then((response)=>{
					this.validationErrors = [];
					if(response.data.status == 'error'){
						this.validationErrors = response.data.errors;
					} else if(response.data.status == 'done'){
						this.$router.push(this.$router.resolve({name: 'AdminUsersList'}).href);
					}
				}).catch(error  => { 
					console.log(error);  
				});
				return false;
            },  
        },  
		data : function () {
            return { 
				textButton: 'Add user',
				idUser: 0,
				name: null,
				email: null,
				password: null,
				validationErrors: [],
            }
        },
    }
</script>
