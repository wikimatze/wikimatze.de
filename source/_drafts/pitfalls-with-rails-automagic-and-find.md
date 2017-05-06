---
title:
meta-description: ...
published: false
---
# Pits when posting
Scenario: Issues with updating some user Information.

In The controller:

def edit
    @user = OmcConnector::Contact.find(current_user.id)

    if request.post?
      cleaned_contact_attributes = params[:omc_connector_contact].reject { |key, _| !EDITABLE_ATTRIBUTES.include?(key) }
      add_error_messages_for_user(cleaned_contact_attributes)

      if @user.errors.empty? && @user.valid?
        notify_astra_about_profile_change(@user, cleaned_contact_attributes, params[:user][:omc_connector_account], params[:user][:location])
        @user.load(cleaned_contact_attributes)
        @user.save
      else
        raise ActiveResource::ResourceInvalid.new('Please set all required fields.')
      end

      flash[:notice] = t('extranet.edit.profile_updated', :default => 'Profile successfully updated.')
      redirect_to(:action => 'profile')
    end
  rescue ActiveResource::ResourceInvalid
    flash.now[:error] = t('extranet.edit.edit_failed', :default => 'Failed to update profile.')
  end


In the view:

- form_for(@user, :html => {:name => 'editProfile'}, :url => { :controller => 'user', :action => "edit" }, :builder => ErrorDescriptionFormBuilder) do |f|


The problem: When I hit the submit button nothing happened

Solution: When using find in the model and the instance variable is passed in the view, rails guesses out of the method (her __find__) which method for the object should be used in a request. So when the object is fetched via find, rails automatically thinks we have an update method. This was the solution was to add explicit the method for the controller:

- form_for(@user, :html => {:name => 'editProfile', :method => 'POST'}, :url => { :controller => 'user', :action => "edit" }, :builder => ErrorDescriptionFormBuilder) do |f|


Lessons learned. Be aware of Rails Magic. It is in some kind good, it does a lot of stuff for you, but when not, you are looking like a dog without eyes


## Conclusion

## Further reading

-
-
-


