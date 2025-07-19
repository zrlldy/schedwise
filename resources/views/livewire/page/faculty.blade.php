<div>
    <div class="flex flex-col justify-center items-center gap-2">

        <div class="bg-orange-200 rounded-md p-4 text-center font-bold max-w-[60%] w-full mb-5">
            <nav>
                <p class="text-2xl"> Schedwise</p>
            </nav>
        </div>


        <div class="flex flex-row justify-between w-full mt-5 gap-2 ">
            <div class="ml-4 flex gap-4">
                <flux:input as="input" placeholder="Search..." icon="magnifying-glass" kbd="⌘K" />
                <flux:dropdown>
                    <flux:button icon:trailing="chevron-down">Department</flux:button>

                    <flux:menu>
                        <flux:menu.item icon="pencil-square" kbd="⌘S">BSIT</flux:menu.item>
                        <flux:menu.item icon="document-duplicate" kbd="⌘D">BSIE</flux:menu.item>
                        <flux:menu.item icon="trash" kbd="⌘⌫">BEED</flux:menu.item>
                        <flux:menu.item icon="trash" kbd="⌘⌫">BTLED</flux:menu.item>

                    </flux:menu>
                </flux:dropdown>
            </div>



            <div class="mr-10">

                <flux:modal.trigger name="add-faculty">
                    <flux:button variant="primary" color="teal">Add Faculty</flux:button>
                </flux:modal.trigger>




            </div>
        </div>

        <div class=" mt-5 rounded p-2 w-full  h-dvh border shadow-sm">
            <div class="overflow-x-auto">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Job</th>
                            <th>Favorite Color</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        <tr class="bg-base-200">
                            <th>1</th>
                            <td>Cy Ganderton</td>
                            <td>Quality Control Specialist</td>
                            <td>Blue</td>
                        </tr>
                        <!-- row 2 -->
                        <tr>
                            <th>2</th>
                            <td>Hart Hagerty</td>
                            <td>Desktop Support Technician</td>
                            <td>Purple</td>
                        </tr>
                        <!-- row 3 -->
                        <tr>
                            <th>3</th>
                            <td>Brice Swyre</td>
                            <td>Tax Accountant</td>
                            <td>Red</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


    </div>


    <flux:modal name="add-faculty" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update profile</flux:heading>
                <flux:text class="mt-2">Make changes to your personal details.</flux:text>
            </div>
            <flux:input label="Name" placeholder="Your name" />
            <flux:input label="Date of birth" type="date" />
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>

</div>
