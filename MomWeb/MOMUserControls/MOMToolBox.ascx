<%@ Control Language="C#" AutoEventWireup="true" CodeFile="MOMToolBox.ascx.cs" Inherits="MOMUserControls_MOMToolBox" %>
<%@ Register Assembly="AjaxControlToolkit" Namespace="AjaxControlToolkit" TagPrefix="cc1" %>
<div>
<asp:Panel ID="momToolBox" runat="server" BackColor="White" ForeColor="#aa3464"
      BorderWidth="1" BorderStyle="solid" BorderColor="Pink" 
      style="z-index: 1; width:1000px; height:20px; vertical-align: middle; background-color: MistyRose; position: relative;">
          <div style="width: 100%; height: 100%; vertical-align: middle; text-align: left;">
              <table cellpadding="3" cellspacing="0" width="100%">
                  <tr>
                      <td align="left">
                          <small>Applications</small>
                      </td>
                      <td align="left">
                          <small>Photos</small>
                      </td>
                      <td align="left">
                          <small>Videos</small>
                      </td>
                      <td align="left">
                          <small>Groups</small>
                      </td>
                      <td align="left">
                         <small> Recipes</small>
                      </td>
                      <td align="left">
                          <small>Share Links</small>
                      </td>
                      <td style="width: 70%">
                      </td>
                  </tr>
              </table>
          </div>
  </asp:Panel>
  <cc1:AlwaysVisibleControlExtender ID="avce" runat="server"
      TargetControlID="momToolBox"
      VerticalSide="bottom"
      VerticalOffset="0"
      HorizontalSide="Center" 
      HorizontalOffset="0"
      ScrollEffectDuration=".1" />
  </div>
