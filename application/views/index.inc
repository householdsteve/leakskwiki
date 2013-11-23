{% if pagevars.ajax  != "yep" %}
  {% include 'inc/header.php' %}
<section class="head">
<div class="row">
  <div class="col-xs-12 col-sm-3">
    <h1 class="logo">kwiki<strong>leaks</strong></h1>
  </div>
  <div class="col-xs-12 col-sm-9">
    <div class="underline thin">
     <h2>A new way to read and share <a href="http://kwikdesk.com/"><strong>kwikdesk</strong></a> with others
    in a <strong>completely anonymous</strong> manner, without leaving a trace.
    </h2>
    </div>
    <div class="hidden-xs underline thin">
    <!-- AddThis Button BEGIN -->
    <div class="addthis_toolbox addthis_default_style ">
    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
    <a class="addthis_button_tweet"></a>
    <a class="addthis_counter addthis_pill_style"></a>
    </div>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-506df57675fd16ac"></script>
    <!-- AddThis Button END -->
    </div>
  </div>
</div> 
</section>


<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-3">
      <strong>We found these KWIK(s):</strong>
    </div>
  </div>
  {% endif %}
  <section class="infiniteparent">
  {% for key,row in data['data'] %}
  <div class="container underline infinite-item">
    <div class="row">
      <div class="name">
        <h3>{{row['content']}}</h3>
      </div>
    </div>
  <div class="row">
    <p>Was supposed to self-destruct {{row['expires']|date("m/d/Y")}}</p>
  </div>
  
  </div>
    {% endfor %}
    {{data["pagination"] | raw}}
  </section>
  {% if pagevars.ajax  != "yep" %}
</section>
  {% include 'inc/footer.php' %}
{% endif %}