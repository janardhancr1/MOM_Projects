using System;
using System.Collections.Generic;
using System.Text;

namespace BOMomburbia
{
    public class MOMException : Exception 
    {
        public MOMException()
            : base()
        {
        }

        public MOMException(string message)
            : base(message)
        {
        }
    }
}
