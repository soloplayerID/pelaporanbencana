const form = {
	temp : [],
	save : (frm,uri,uriback)=>{
			$('#save').html('<i class="fa fa-spinner fa-pulse"></i>  Loading .. !')
			$('#save').prop('disabled',true)
			$.ajax({
				url : uri,
				type : 'POST',
				data : $(frm).serialize(),
				success : (res)=>{
						Pace.stop();
					$('#save').text('Submit')
					$('#save').prop('disabled',false)
					if (res == '200') {
						swal({
							icon : "success",
				      title: "Information!",
				      text: "Success Save Data!",}).then(okay => {
				          if (okay) {
										if (uriback = null) {
										}else if (uriback = 'reload') {
						               location.reload();
										}else{
												window.location.href = uriback;
										}
				          }
				      });
						$(frm)[0].reset()
					}else{
						swal({
							icon : "warning",
				      title: "Information!",
				      text: "Failed Save Data!",
				      type: "warning"}).then(okay => {
				          if (okay) {
				               location.reload();
				          }
				      });
					}
				},
        ajaxSend: function(){
					Pace.start();
        },
        beforeSend: function(){
					Pace.start();
        },
		    error: function (request, status, error) {
						swal("ERROR!", request.responseText, "error");
		    }
			})
	},
	delete : (uri)=>{
		  swal({
		    title: "Are you sure?",
		    text: "Once deleted, you will not be able to recover this data!",
		    icon: "warning",
		    buttons: true,
		    dangerMode: true,
		  })
		  .then((willDelete) => {
		    if (willDelete) {
		        $.ajax({
		            url     : uri,
		            type    : "GET",
		            success : (res)=>{
									Pace.stop();
		    					if (res == '200') {
		    						swal({
		    							icon : "success",
		    				      title: "Information!",
		    				      text: "Success Delete Data!",}).then(okay => {
		    				          if (okay) {
		    				               location.reload();
		    				          }
		    				      });
		    					}else{
		    						swal({
		    							icon : "warning",
		    				      title: "Information!",
		    				      text: "Failed Delete Data!",
		    				      type: "warning"}).then(okay => {
		    				          if (okay) {
		    				               location.reload();
		    				          }
		    				      });
		    					}
		            },
				        ajaxSend: function(){
										Pace.start();
				        },
				        beforeSend: function(){
										Pace.start();
				        },
						    error: function (request, status, error) {
										swal("ERROR!", request.responseText, "error");
						    }
		        })
		    } else {
		      swal("Your Data is safe!");
		    }
		  });
	},
	UpdateStatus : (uri,status)=>{
			  swal({
			    title: "Are you sure? to "+(status == 1 ? 'Non Active' : 'Active')+" This Data",
			    text: "",
			    icon: "warning",
			    buttons: true,
			    dangerMode: true,
			  })
			  .then((willDelete) => {
			    if (willDelete) {
			        $.ajax({
			            url     : uri,
			            type    : "GET",
			            success : (res)=>{
										Pace.stop();
			    					if (res == '200') {
			    						swal({
			    							icon : "success",
			    				      title: "Information!",
			    				      text: "Success Update Data!",}).then(okay => {
			    				          if (okay) {
			    				               location.reload();
			    				          }
			    				      });
			    					}else{
			    						swal({
			    							icon : "warning",
			    				      title: "Information!",
			    				      text: "Failed Update Data!",
			    				      type: "warning"}).then(okay => {
			    				          if (okay) {
			    				               location.reload();
			    				          }
			    				      });
			    					}
			            },
					        ajaxSend: function(){
											Pace.start();
					        },
					        beforeSend: function(){
											Pace.start();
					        },
							    error: function (request, status, error) {
											swal("ERROR!", request.responseText, "error");
							    }
			        })
			    } else {
			      swal("Your Data is safe!");
			    }
			  });
	},
	doneTodo : (uri,status,el)=>{
			swal({
				title: "Are you sure? to "+(status == 0 ? 'Success' : 'Un Success')+" This List",
				text: "",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
						$.ajax({
								url     : uri,
								type    : "GET",
								success : (res)=>{
									Pace.stop();
									if (res == '200') {
										swal({
											icon : "success",
											title: "Information!",
											text: "Success Update Data!",}).then(okay => {
													if (okay) {
															 location.reload();
													}
											});
									}else{
										swal({
											icon : "warning",
											title: "Information!",
											text: "Failed Update Data!",
											type: "warning"}).then(okay => {
													if (okay) {
															 location.reload();
													}
											});
									}
								},
								ajaxSend: function(){
										Pace.start();
								},
								beforeSend: function(){
										Pace.start();
								},
								error: function (request, status, error) {
										swal("ERROR!", request.responseText, "error");
								}
						})
				} else {
					swal("Your Data is safe!");
					el.prop('checked',false)
					el.parent().removeClass('done');
					console.log(el.parent());
				}
			});
	},
	Aprove : (uri,el)=>{
			swal({
				title: "Are you sure? to Aprove This Activity",
				text: "",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
						$.ajax({
								url     : uri,
								type    : "GET",
								success : (res)=>{
									Pace.stop();
									if (res == '200') {
										swal({
											icon : "success",
											title: "Information!",
											text: "Success Aprove Data!",}).then(okay => {
													if (okay) {
															 location.reload();
													}
											});
									}else{
										swal({
											icon : "warning",
											title: "Information!",
											text: "Failed Aprove Data!",
											type: "warning"}).then(okay => {
														el.prop('checked',false)
														el.parent().removeClass('done');
													if (okay) {
															 location.reload();
													}
											});
									}
								},
								ajaxSend: function(){
										Pace.start();
								},
								beforeSend: function(){
										Pace.start();
								},
								error: function (request, status, error) {
										swal("ERROR!", request.responseText, "error");
								}
						})
				} else {
					swal("Your Data is safe!");
					el.prop('checked',false)
					el.parent().removeClass('done');
					console.log(el.parent());
				}
			});
	},
	SuccessReq : (uri,el)=>{
			swal({
				title: "Are you sure? Success This Requirement",
				text: "",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
						$.ajax({
								url     : uri,
								type    : "GET",
								success : (res)=>{
									Pace.stop();
									if (res == '200') {
										swal({
											icon : "success",
											title: "Information!",
											text: "Success Aprove Data!",}).then(okay => {
													if (okay) {
															 location.reload();
													}
											});
									}else{
										swal({
											icon : "warning",
											title: "Information!",
											text: "Failed Aprove Data!",
											type: "warning"}).then(okay => {
														el.prop('checked',false)
														el.parent().removeClass('done');
													if (okay) {
															 location.reload();
													}
											});
									}
								},
								ajaxSend: function(){
										Pace.start();
								},
								beforeSend: function(){
										Pace.start();
								},
								error: function (request, status, error) {
										swal("ERROR!", request.responseText, "error");
								}
						})
				} else {
					swal("Your Data is safe!");
					el.prop('checked',false)
					el.parent().removeClass('done');
					console.log(el.parent());
				}
			});
	},
	StartPoc : (uri,url)=>{
			swal({
				title: "Are you sure? Start This Poc",
				text: "",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
						$.ajax({
								url     : uri,
								type    : "GET",
								success : (res)=>{
									Pace.stop();
									if (res == '200') {
										swal({
											icon : "success",
											title: "Information!",
											text: "Success Start Data!",}).then(okay => {
													if (okay) {
															 window.location.href = url;
													}
											});
									}else{
										swal({
											icon : "warning",
											title: "Information!",
											text: "Failed Aprove Data!",
											type: "warning"}).then(okay => {
													if (okay) {
															 location.reload();
													}
											});
									}
								},
								ajaxSend: function(){
										Pace.start();
								},
								beforeSend: function(){
										Pace.start();
								},
								error: function (request, status, error) {
										swal("ERROR!", request.responseText, "error");
								}
						})
				} else {
					swal("Your Data is safe!");
				}
			});
	},
	DONEPOC : (uri,url)=>{
			swal({
				title: "Are you sure? DONE This Poc",
				text: "",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
						$.ajax({
								url     : uri,
								type    : "GET",
								success : (res)=>{
									Pace.stop();
									if (res == '200') {
										swal({
											icon : "success",
											title: "Information!",
											text: "Success DONE Data!",}).then(okay => {
													if (okay) {
															 window.location.href = url;
													}
											});
									}else{
										swal({
											icon : "warning",
											title: "Information!",
											text: "Failed DONE Data!",
											type: "warning"}).then(okay => {
													if (okay) {
															 location.reload();
													}
											});
									}
								},
								ajaxSend: function(){
										Pace.start();
								},
								beforeSend: function(){
										Pace.start();
								},
								error: function (request, status, error) {
										swal("ERROR!", request.responseText, "error");
								}
						})
				} else {
					swal("Your Data is safe!");
				}
			});
	}
}
