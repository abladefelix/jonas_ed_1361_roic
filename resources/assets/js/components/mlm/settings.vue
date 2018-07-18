<template>

  <div>

    <!-- Settings section -->
    <div class="container">
      <div class="row">
        <div class="col-10">


    <div style="margin-bottom: 40px;">
      <form style="margin-bottom: 10px;">
        <h3>Settings</h3>
        <!-- First Name, Last Name -->
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="firstName">First Name</label>
              <input type="text" class="form-control" id="firstName" placeholder="First Name" v-model="user.firstname">
            </div>
            <div class="form-group col-md-6">
              <label for="lastName">Last Name</label>
              <input type="text" class="form-control" id="lastName" placeholder="Last Name" v-model="user.lastname">
            </div>
        </div>

        <!-- Username --
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" placeholder="Username" v-model="user.username">
            </div>
        </div>-->

        <!-- Email, Phone
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="username">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Email" v-model="user.email">
            </div>
            <div class="form-group col-md-6">
              <label for="username">Phone</label>
              <input type="phone" class="form-control" id="phone" placeholder="Phone">
            </div>
        </div>-->

        <!-- Address -->
        <div class="form-group">
            <label for="inputAddress">Street</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" v-model="user.address">
        </div>

        <!-- Address 2
        <div class="form-group">
            <label for="inputAddress2">Address 2</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
          </div>-->

          <!-- Country, Country Code --
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="country">Country</label>
              <input type="text" class="form-control" id="country" placeholder="Country">
            </div>
            <div class="form-group col-md-6">
              <label for="countryCode">Country Code</label>
              <input type="text" class="form-control" id="countryCode" placeholder="Country Code" v-model="user.countrycode">
            </div>
        </div>-->

        <!-- City, State, Zip -->
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="city">City</label>
              <input type="text" class="form-control" id="city" placeholder="City" v-model="user.city">
            </div>
            <!--<div class="form-group col-md-4">
              <label for="inputState">State</label>
              <input type="text" class="form-control" id="state" placeholder="State">
            </div>-->
            <div class="form-group col-md-6">
              <label for="zip">Postal Code</label>
              <input type="text" class="form-control" id="zip" placeholder="Zip">
            </div>
        </div>
        <button type="button" class="btn btn-primary" v-on:click="updateUser()">Update Profile</button>
      </form>

      <!-- Success Alert -->
      <div class="alert alert-success" role="alert" v-if="settingsUpdatedSuccess == true" >
        Your Settings have been updated.
      </div>

      <!-- Error Alert -->
      <div class="alert alert-danger" role="alert" v-if="settingsUpdatedError == true">
        Error updating your Settings.
      </div>
    </div>

  </div> <!-- end col -->
  </div> <!-- end row -->
  </div> <!-- end container -->


    <!-- Password section -->
    <div class="container">
      <div class="row">
        <div class="col-10">
    
      <div style="margin-bottom: 80px;">
        <form style="margin-bottom: 10px;">
          <h3>Password</h3>
          <div class="form-row">
              <div class="form-group col-md-6">
                <label for="actualPassword">Actual Password</label>
                <input type="text" class="form-control" id="actualPassword" placeholder="Actual Password" v-model.lazy="actualPassword">
              </div>
          </div>
          <div class="form-row">
              <div class="form-group col-md-6">
                <label for="newPassword">New Password</label>
                <input type="text" class="form-control" id="newPassword" placeholder="New Password" v-model="newPassword">
              </div>
              <div class="form-group col-md-6">
                <label for="repeatedNewPassword">Repeat New Password</label>
                <input type="text" class="form-control" id="repeatedNewPassword" placeholder="Repeat New Password" v-model="repeatedNewPassword">
              </div>
          </div>
          <button type="button" class="btn btn-primary" v-on:click="updatePassword()">Update Password</button>
        </form>

      <!-- Success Alert -->
      <div class="alert alert-success" role="alert" v-if="passwordUpdatedSuccess == true">
        Your Password has been updated.
      </div>

      <!-- Error Alert -->
      <div class="alert alert-danger" role="alert" v-if="passwordUpdatedError == true">
        {{ passwordErrorMessage }}
      </div>
      </div>

    </div> <!-- end col -->
    </div> <!-- end row -->
    </div> <!-- end container -->

  </div>

</template>

<script type="text/javascript">
  export default {
    data(){
      return{
        user:{
              id: '',
              username: '',
              email: '',
              password: '',
              firstname: '',
              lastname:'',
              address: '',
              countrycode: '',
              city: ''
            },
            actualPassword: '', // actual password entered
            newPassword: '', // new password entered
            repeatedNewPassword: '', // repeated new password
            settingsUpdatedSuccess: false, // settings update successful
            settingsUpdatedError: false, // settings update has error
            passwordUpdatedSuccess: false, // password update successful
            passwordUpdatedError: false, // password update has error
            passwordErrorMessage: '', // password error message
            passwordCorrect:{
              status: ''
            }
      }
    },
    created(){
      var vm = this;
      vm.getUserSettings(); // get Settings of User
    },
    methods:{
      // get Settings of User
      // its response contains User object
      getUserSettings(){
        var vm = this;
        $.getJSON('/api/partner/profile/settings', function(response){
          vm.user = response[0];
        });
      },
      //update User
      updateUser(){
        var vm = this;
        $.ajax({
          headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
          url: '/api/partner/update',
          type: 'POST',
          data: vm.user,
          success: function(data) {
                    //successmessage = 'Data was succesfully captured';
                    vm.settingsUpdatedSuccess = true; // set to true
                    vm.settingsUpdatedError = false; // set to false
                },
                error: function (data) {
                  console.log('An error occurred.');
                    console.log(data);
                    vm.settingsUpdatedSuccess = false; // set to false
                    vm.settingsUpdatedError = true; // set to true
                }
        });
      },
      // update Password
      updatePassword(){
        var vm = this;

        // if all 3 fields are empty or blank
        if ( vm.actualPassword == "" || vm.newPassword == "" || vm.repeatedNewPassword == "" )
        {
          vm.passwordUpdatedSuccess = false; // false
          vm.passwordUpdatedError = true; // true
          vm.passwordErrorMessage = "Please fill out all 3 fields."; // error message
        }
        // if Passwords don't match
        else if ( vm.newPassword != vm.repeatedNewPassword )
        {
          vm.passwordUpdatedSuccess = false; // false
          vm.passwordUpdatedError = true; // true
          vm.passwordErrorMessage = "Passwords don't match!"; // error message
        }
        // if passwords don't have at least 8 characters
        else if ( vm.newPassword.length < 8 || vm.repeatedNewPassword.length < 8 )
        {
          vm.passwordUpdatedSuccess = false; // false
          vm.passwordUpdatedError = true; // true
          vm.passwordErrorMessage = "Your Password must have at least 8 characters."; // error message
        }
        // check if actual password entered is correct
        // if yes, password can be updated
        else
        {
          // check if actual password entered is correct
          $.getJSON('/api/partner/' + vm.user.id + '/checkpassword/' + vm.actualPassword, function(response){
            //vm.passwordCorrect = response[0];
            //console.log("Response status is " + vm.passwordCorrect.status);
            
            // if actual password entered is correct
            if ( response[0].status == "true" )
            {
              // password will be updated
              // console.log("PASSWORD CAN BE UPDATED!!!");
              vm.user.password = vm.newPassword; // assign new password value to User password property
              
              // send new password via ajax post request
              $.ajax({
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                url: '/api/partner/update/password',
                type: 'POST',
                data: vm.user,
                success: function(data) {
                          vm.passwordUpdatedSuccess = true; // set to true
                          vm.passwordUpdatedError = false; // set to false
                          vm.passwordErrorMessage = ""; // error message
                      },
                      error: function (data) {
                        console.log('An error occurred.');
                          console.log(data);
                          vm.passwordUpdatedSuccess = false; // set to false
                          vm.passwordUpdatedError = true; // set to true
                          vm.passwordErrorMessage = "Error updating password.\n" + data; // error message
                      }
              });
            }
            // current password is wrong
            else
            {
              vm.passwordUpdatedSuccess = false; // false
              vm.passwordUpdatedError = true; // true
              vm.passwordErrorMessage = "Actual Password is wrong."; // error message
              
              // console.log("PASSWORD CANNOT BE UPDATED!!!");
            }
          }); 
        }
        // empty all password values
        vm.actualPassword = "";
        vm.newPassword = "";
        vm.repeatedNewPassword = "";
      }
    }
  }
</script>