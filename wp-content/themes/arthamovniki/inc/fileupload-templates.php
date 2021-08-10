<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
		<tr class="template-upload fade{%=o.options.loadImageFileTypes.test(file.type)?' image':''%} memorial-block__upload-card-block">
			<td class="memorial-block__upload-card-photo"><span class="preview"></span></td>
			<td class="memorial-block__upload-card-name"><p class="name">{%=file.name%}</p><strong class="error text-danger"></strong></td>
			<td class="memorial-block__upload-card-size">
				<p class="size">Загружается...</p>
				<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
			</td>
			<td>
				{% if (!i) { %}
				    <a href="javascript:;" class="memorial-block__upload-delete-link cancel">
						<span>Отмена</span>
					</a>
				{% } %}
			</td>
		</tr>
	{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
		<tr class="template-download fade{%=file.thumbnailUrl?' image':''%} memorial-block__upload-card-block">
			<td class="memorial-block__upload-card-photo">
			    <a href="{%=file.url%}" data-fancybox="images">
			        <img src="{%=file.thumbnailUrl%}" style="max-width: 150px;">
			    </a>
			</td>
			<td class="memorial-block__upload-card-name">
				{%=file.name%}
                {% if (file.error) { %}
                    <div><span class="label label-danger">Ошибка</span> {%=file.error%}</div>
                {% } %}
			</td>
            <td class="memorial-block__upload-card-size">{%=o.formatFileSize(file.size)%}</td>
            <td>
                {% if (file.deleteUrl) { %}
                    <a href="javascript:;" class="memorial-block__upload-delete-link delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}">
						<span>Удалить</span>
					</a>
                {% } else { %}
                    <a href="javascript:;" class="memorial-block__upload-delete-link cancel">
						<span>Отмена</span>
					</a>
                {% } %}
            </td>
		</tr>
	{% } %}
</script>