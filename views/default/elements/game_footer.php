<? $view_output .= '
</div>

				<div class="col-md-4 col-sm-4 hidden-xs">
'; ?>
						<? Core::get_element('badges_dashlet'); ?>
						<? Core::get_element('activity_dashlet'); ?>
<? $view_output .= '	
				</div>
			
			</div>
		
		</div>

</div>
		
		<!-- InstanceBeginEditable name="customscripts" --> 

		<script src="/js/custom.js?t=123334"></script>

<!-- InstanceEndEditable -->
		<div style="height: 100px">&nbsp;</div>
'; ?>
<?
Core::get_element('page_footer');
?>