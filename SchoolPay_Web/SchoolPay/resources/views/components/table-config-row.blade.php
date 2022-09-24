@props(['level'])

<tr {{$attributes->merge(["class" => "border-b bg-transparent border-white hover:bg-gradient-logo"])}}>

  <th scope="row" class="py-2 px-3 text-center font-medium whitespace-nowrap text-white">
    {{ $level }}
  </th>
  <th scope="row" class="py-2 px-3 text-center font-medium whitespace-nowrap text-white">
    <div class="flex items-center rounded">
      <input type="date"
           id="startAt"
           class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
    </div>
  </th>
  <td class="py-2 px-3 text-center">
    <div class="flex items-center rounded">
      <input id="canPayDischargeFirstPart"
           type="checkbox" value=""
           name="canPayDischargeFirstPart"
           class="w-4 h-4 text-blue-600 bg-transparent rounded border-gray-300">
      <label for="canPayDischargeFirstPart"
           class="py-2 ml-2 w-full text-sm font-medium text-white">
            <x-input type="number"
                     placeholder="Montant"
                     class="bg-transparent text-white"
                     name="dischargeFirstPartAmount"/>
      </label>
    </div>
  </td>
  <td class="py-2 px-3 text-center">
      <div class="flex items-center  rounded">
          <input id="canPayDischargeSecondPart"
                 type="checkbox" value=""
                 name="canPayDischargeSecondPart"
                 class="w-4 h-4 text-blue-600 bg-transparent rounded border-gray-300">
          <label for="canPayDischargeSecondPart"
                 class="py-2 ml-2 w-full text-sm font-medium text-white">
              <x-input type="number"
                       placeholder="Montant"
                       class="bg-transparent text-white"
                       name="dischargeSecondPartAmount"/>
          </label>
      </div>
  </td>
  <td class="py-2 px-3 text-center">
      <div class="flex items-center  rounded">
          <input id="canPayMedicalVisit"
                 type="checkbox" value=""
                 name="canPayDischargeFirstPart"
                 class="w-4 h-4 text-blue-600 bg-transparent rounded border-gray-300">
          <label for="canPayMedicalVisit"
                 class="py-2 ml-2 w-full text-sm font-medium text-white">
              <x-input type="number"
                       placeholder="Montant"
                       class="bg-transparent text-white"
                       name="medicalVisitAmount"/>
          </label>
      </div>
  </td>
</tr>
