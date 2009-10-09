using System;
using System.Collections.Generic;
using System.Text;

namespace DALMomburbia
{
    public class MOMProfile : MOMBase
    {
        public MOMProfile() : base()
        {
        }

        public void AddOrUpdateMOM_USR_PRFRow(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;
        }
    }
}
