<div>
    <div class="flex flex-col justify-center items-center gap-2">

        <div class="bg-orange-200 rounded-md p-4 text-center font-bold max-w-[70%] w-full mb-5">

            <header class="text-2xl font-bold">Subject</header>

        </div>


        <div class="flex flex-row justify-between w-full mt-5 gap-2 ">


            <div class="ml-4 flex gap-4">
                <flux:input as="input" placeholder="Search..." icon="magnifying-glass" kbd="⌘K" />
                <flux:dropdown>
                    <flux:button icon:trailing="chevron-down">Department</flux:button>

                    <flux:menu>
                        <flux:menu.item icon="pencil-square" kbd="⌘S">BSIT</flux:menu.item>
                        <flux:menu.item icon="document-duplicate" kbd="⌘D">BSIE</flux:menu.item>
                        <flux:menu.item icon="trash" variant="danger" kbd="⌘⌫">BEED</flux:menu.item>
                        <flux:menu.item icon="trash" variant="danger" kbd="⌘⌫">BTLED</flux:menu.item>

                    </flux:menu>
                </flux:dropdown>
            </div>



            <div class="mr-10">

                <flux:modal.trigger name="add-faculty">
                    <flux:button variant="primary" color="teal">Add Subject</flux:button>
                </flux:modal.trigger>




            </div>
        </div>

        <div class=" mt-5 rounded p-2 w-full  h-dvh border shadow-sm">
            <div class="bg-red-300 rounded-sm text-center p-2 font-bold text-2xl mb-4"> Subject for {Department} </div>
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


    <flux:modal name="add-faculty" class="md:w-106">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg" class="text-center">Add Subject</flux:heading>
                <flux:text class="mt-2">Add a subject to a specific course </flux:text>
            </div>
            <flux:input label="Subject" placeholder="Subject Name" />
            <flux:input label="Subject Code" placeholder="Subject Code" />
            <div class="flex  flex-row gap-2">
                <div>
                    <flux:dropdown>
                        <flux:button icon:trailing="chevron-down">Department</flux:button>
                        <flux:menu keep-open>
                            <flux:menu.checkbox wire:model="read" checked>BSIT</flux:menu.checkbox>
                            <flux:menu.checkbox wire:model="write">BEED</flux:menu.checkbox>
                            <flux:menu.checkbox wire:model="delete">BTLED</flux:menu.checkbox>
                            <flux:menu.checkbox wire:model="delete">BEED</flux:menu.checkbox>
                        </flux:menu>
                    </flux:dropdown>
                </div>
                <div>

                    <flux:select size="md" placeholder="Course Year">
                        <flux:select.option>1st Year</flux:select.option>
                        <flux:select.option>2nd Year</flux:select.option>
                        <flux:select.option>3rd Year</flux:select.option>
                        <flux:select.option>4th Year</flux:select.option>

                    </flux:select>
                </div>

                <div>
                    <flux:dropdown>
                        <flux:button icon:trailing="chevron-down">Term</flux:button>
                        <flux:menu keep-open>
                            <flux:menu.checkbox wire:model="read" checked>1st Semester</flux:menu.checkbox>
                            <flux:menu.checkbox wire:model="write">2nd Semester</flux:menu.checkbox>

                        </flux:menu>
                    </flux:dropdown>
                </div>

            </div>


            <div class="flex item-center text-center justify-center">
                <flux:spacer />
                <flux:button type="submit" variant="primary">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>

</div>
