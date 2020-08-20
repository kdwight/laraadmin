<v-app style="background-image: linear-gradient(-130deg, #43cea2, #185a9d);">
    <v-container fill-height>
        <v-row justify="center">
            <v-col xs="12" sm="8" md="5" xl="4">
                @if ($message = session('login-error'))
                <v-alert dense type="error">
                    {{ $message }}
                </v-alert>
                @endif

                <form action="{{ url('/admin/login') }}" method="POST">
                    @csrf

                    <v-text-field dark label="Email" name="email" prepend-icon="mdi-email" type="text"
                        value="{{ old('email') }}">
                    </v-text-field>

                    <v-text-field label="Password" name="password" prepend-icon="mdi-lock" type="password"
                        value="password" dark>
                    </v-text-field>

                    <div style="margin-left: 32px;">
                    <input type="checkbox" name="remember"> <span style="color: white">Remember Me</span>
                    </div>

                    <v-card-actions class="d-flex justify-end">
                        <v-btn type="submit" class="rounded-lg" color="info" :ripple="false" min-width="150" large>
                            Sign In
                        </v-btn>
                    </v-card-actions>
                </form>
            </v-col>
        </v-row>
    </v-container>
</v-app>