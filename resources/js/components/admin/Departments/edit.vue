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
							<router-link :to="{name:'AdminDepartmentsList'}" class="btn btn-success btn-sm">Back</router-link>
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
													<span class="input-group-text"><i class="fas fa-edit"></i></span> 
												</div> 
												<textarea class="form-control" v-model="description" placeholder="Description" style="height:100px"></textarea> 
											</div>
										</div> 
										<div class="form-group col-12">
											<div class="input-group">
												<div class="custom-file">
													<input type="file" @change="selectFile" class="custom-file-input" placeholder="photo" id="InputLogo" />
													<label class="custom-file-label" for="InputLogo">Choose logo</label>
												</div>
											</div>
											<img src="" :src="logo" alt="" class="mt-2" style="max-width:200px" />
											<a href="javascript://" v-if="this.logo!=null" @click="deleteLogo">Delete logo</a>
										</div>
										<h5 class="ml-3">Users:</h5>
										<div class="form-group row m-3">
											<div v-if="Object.keys(userslist).length>0" v-for="user in userslist" class="form-group col-4"> 
												<div class="form-check">
													<input type="checkbox" :id="user.id" :value="user.id"  v-model="users[user.id]" class="form-check-input">
													<label class="form-check-label" :for="user.id">{{user.name}}</label>
												 </div> 
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
			// Editor -> Load info department
			if(this.$route.params.id !== undefined){
				this.id = this.$route.params.id;
				this.textButton = 'Edit department';
				axios.post(this.$router.resolve({name: 'AdminDepartmentsAjaxGetDepartmentInfo'}).href, {
					id: this.id,
				}).then((response)=>{
					if(response.data.status == 'done'){
						this.name = response.data.name;
						this.description = response.data.description;
						this.logo = response.data.logo;
					} else {
						this.$router.push(this.$router.resolve({name: 'AdminDepartmentsList'}).href);
					}
				}).catch(error  => { 
					console.log(error);  
				});
			}
			// Get all users
			axios.post(this.$router.resolve({name: 'AjaxGetDepartmentUser'}).href, {
					id: this.id,
				}).then((response)=>{
					if(response.data.status == 'done'){
						this.userslist = response.data.users;
						this.users = response.data.usersChecked;
						console.log(this.users);
					} 
				}).catch(error  => { 
					console.log(error);  
				});
        },
		methods: {
            submitForm: function() {
				let url  = this.$router.resolve({name: 'AdminDepartmentsAdd'}).href;
				let data = {
					name: this.name, 
					description: this.description,
					logo: this.logo,
					users: this.users,
				};
				if(this.id > 0 ){
					url  = this.$router.resolve({name: 'AdminDepartmentsEdit', params: { id: this.id }}).href;
					data.id = this.id;
				}
				axios.post(url, data).then((response)=>{
					this.validationErrors = [];
					if(response.data.status == 'error'){
						this.validationErrors = response.data.errors;
					} else if(response.data.status == 'done'){
						this.$router.push(this.$router.resolve({name: 'AdminDepartmentsList'}).href);
					}
				}).catch(error  => { 
					console.log(error);  
				});
				return false;
            },    
			deleteLogo(){
				if(confirm("Do you really want to delete?")){
					this.photo = null;
					this.logo = null;
				}
			},
			selectFile(event) {
				this.photo = event.target.files[0];
				if (this.photo == undefined || !this.photo.type.match(/image.*/)) {
					return false;
				}
				this.createBase64Image(this.photo);
			},
			createBase64Image(objectFile){
				let reader = new FileReader();
				reader.onload = (e) => {
					this.logo = e.target.result;
				}
				reader.readAsDataURL(objectFile);
			}
        },  
		data : function () {
            return { 
				textButton: 'Add department',
				id: 0,
				users: [],
				userslist: [],
				name: null,
				description: null,
				password: null,
				photo: null,
				logo: null,
				validationErrors: [],
            }
        },
    }
</script>
