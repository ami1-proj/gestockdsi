<td class="text-left">{{ $currval->libelle }}</td>
<td class="text-left">{{ $currval->description }}</td>
<td class="text-left"><img src="{{ url(config('app.typearticle_filefolder')).'/'. $currval->image }}" alt="{{ $currval->image }}" style="width:50px;" class="img-thumbnail"></td>
