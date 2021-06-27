	</section>


	</div>
	</body>
	<script>
		$(function() {
			var pgurl = window.location.href.substr(window.location.href
			.lastIndexOf("/") + 1);
			$("#chnge li a").each(function() {
				if ($(this).attr("href") == pgurl || $(this).attr("href") == '')
				$(this).addClass('active');
			})
		});
		
		
	</script>
	<script src="click.js"></script>
</html>