<td>{{ $currval->nom }}</td>
<td>{{ $currval->prenom }}</td>
<td>
 @foreach ($currval->phonenums as $phonenum)
 <span class="badge label-primary">{{ $phonenum->numero }}</span>
 @endforeach
 </td>
 <td>
 @foreach ($currval->adresseemails as $adresseemail)
 <span class="badge label-primary">{{ $adresseemail->email }}</span>
 @endforeach
 </td>

<td>{{ $currval->Raison_Sociale }}</td>
