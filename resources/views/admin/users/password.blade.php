@extends('layouts_admin.master')

@section('content')

<change-password inline-template v-cloak>
    <v-content>
        <v-container fluid>
            <v-layout align-center justify-center>
                <v-flex xs8>
                    <v-card @keyup="enable">
                        <v-card-title>New Password</v-card-title>

                        <v-form>
                            <v-container>
                                <v-flex>
                                    <v-text-field name="old_password" label="Old Password" v-model="oldPassword" required></v-text-field>
                                    <p class="text-danger" v-if="errors.old_password" v-text="errors.old_password[0]"></p>
                                    <p class="text-danger" v-if="errors.not_match" v-text="errors.not_match"></p>
                                </v-flex>

                                <v-flex>
                                    <v-text-field name="password" label="New Password" v-model="password" required></v-text-field>
                                    <p class="text-danger" v-if="errors.password" v-text="errors.password[0]"></p>
                                </v-flex>

                                <v-flex>
                                    <v-text-field name="password_confirmation" label="Confirm Password" v-model="confirmPassword" required></v-text-field>
                                </v-flex>
                            </v-container>

                            <v-btn
                                color="primary"
                                @click="changePassword"
                                :disabled="disabled">Submit</v-btn>
                            <v-btn href="{{ url()->previous() }}" color="error">Cancel</v-btn>
                        </v-form>

                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
  </v-content>
</change-password>

@endsection