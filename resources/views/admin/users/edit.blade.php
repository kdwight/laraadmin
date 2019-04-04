@extends('layouts_admin.master')

@section('content')

<user-form :attributes="{{ $user }}" inline-template v-cloak>
    <v-content>
    <v-container fluid>
      <v-layout align-center justify-center>
        <v-flex xs8>
          <v-card @keyup="enable">
            <v-card-title>New User</v-card-title>

            <v-form>
              <v-container>

                <v-flex>
                    <v-text-field name="username" label="Username" v-model="username" required></v-text-field>
                    <p class="red--text" v-if="errors.username" v-text="errors.username[0]"></p>
                </v-flex>

                <v-flex>
                  <v-select :items="items" item-text="description" item-value="name" name="type" label="Type" v-model="type" @change="enable"></v-select>
                   <p class="red--text" v-if="errors.type" v-text="errors.type[0]"></p>
                </v-flex>

                <v-flex>
                  <v-text-field name="password" label="Password" v-model="password" type="password" required></v-text-field>
                   <p class="red--text" v-if="errors.password" v-text="errors.password[0]"></p>
                </v-flex>

                <v-flex>
                  <v-text-field name="password_confirmation" label="Confirm Password" type="password" v-model="confirmPassword" required></v-text-field>
                </v-flex>

              </v-container>
              <v-btn
                type="submit"
                color="primary"
                @click="updateUser"
                :disabled="disabled">Submit</v-btn>
              <v-btn href="/users" color="error">Cancel</v-btn>
            </v-form>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </v-content>
</user-form>

@endsection