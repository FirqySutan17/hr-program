<table>
  <thead>
      <tr>
          @foreach ($data["main_data"]["HEADER"] as $item)
              <td rowspan="2">{{ $item }}</td>
          @endforeach
          <td colspan="{{ count($data["evaluasi_data"]["HEADER"]) }}">Evaluasi</td>
      </tr>
      <tr>
        @foreach ($data["evaluasi_data"]["HEADER"] as $item)
            <td>{{ $item }}</td>
        @endforeach
      </tr>
  </thead>
  <?php
    unset($data["main_data"]["HEADER"]);
  ?>
  <tbody>
    
        @foreach ($data["main_data"] as $employee_id => $item)
            <tr>
              @foreach ($item as $val)
                <td>{{ $val }}</td>
              @endforeach
              @if (array_key_exists($employee_id, $data['evaluasi_data']))
                @foreach ($data["evaluasi_data"][$employee_id] as $item)
                  <td>{{ $item }}</td>
                @endforeach
              @else
                @foreach ($data["evaluasi_data"]["HEADER"] as $item)
                  <td></td>
                @endforeach
              @endif
            </tr>
        @endforeach
      <tr>
    </tr>
  </tbody>
</table>