<button id="selectUniversityRightToPay" data-dropdown-toggle="dropdownDefaultCheckbox"
        class="w-full border-0 border-b-2 border-gray-300 flex justify-between  text-white bg-transparent font-medium text-sm pr-4 py-2.5 text-center inline-flex items-center"
        type="button">
    Droits universitaires à payer
    <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
         xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
    </svg>
</button>

<!-- Dropdown menu -->
<div id="dropdownDefaultCheckbox"
     class="hidden z-10 w-48 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
     data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom"
     style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 623px);">
    <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200"
        aria-labelledby="selectUniversityRightToPay">
        <li>
            <div class="flex items-center">
                <input id="dischargeFirstPart"
                       name="dischargeFirstPart"
                       type="checkbox" value=""
                       class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                <label for="dischargeFirstPart"
                       class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Première tranche - Quitus
                </label>
            </div>
        </li>
        <li>
            <div class="flex items-center">
                <input checked="" id="dischargeSecondPart"
                       name="dischargeSecondPart"
                       type="checkbox" value=""
                       class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                <label for="dischargeSecondPart"
                       class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Seconde tranche - Quitus
                </label>
            </div>
        </li>
        <li>
            <div class="flex items-center">
                <input id="checkbox-item-3"
                       name="medicalVisit"
                       type="checkbox" value=""
                       class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                <label for="checkbox-item-3"
                       class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Visite Médical
                </label>
            </div>
        </li>
    </ul>
</div>
